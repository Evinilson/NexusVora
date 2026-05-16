@php
    $ga4MeasurementId = config('services.ga4.measurement_id');
    $metaPixelId = config('services.meta_pixel.pixel_id');
@endphp

<button type="button" class="cookie-preferences-button" data-cookie-preferences>
    Gerir cookies
</button>

<script>
    window.NexusVoraConsent = (function () {
        const ga4MeasurementId = @json($ga4MeasurementId);
        const metaPixelId = @json($metaPixelId);
        let googleAnalyticsLoaded = false;
        let metaPixelLoaded = false;

        function deleteCookie(name) {
            const hostParts = window.location.hostname.split('.');
            const domains = ['', window.location.hostname];

            if (hostParts.length > 2) {
                domains.push(`.${hostParts.slice(-2).join('.')}`);
            }

            domains.forEach((domain) => {
                const domainPart = domain ? `; domain=${domain}` : '';
                document.cookie = `${name}=; Max-Age=0; path=/${domainPart}; SameSite=Lax`;
            });
        }

        function deleteMatchingCookies(patterns) {
            document.cookie.split(';').forEach((cookie) => {
                const name = cookie.split('=')[0].trim();
                if (patterns.some((pattern) => pattern.test(name))) {
                    deleteCookie(name);
                }
            });
        }

        function loadGoogleAnalytics() {
            if (!ga4MeasurementId || googleAnalyticsLoaded) return;

            window[`ga-disable-${ga4MeasurementId}`] = false;
            window.dataLayer = window.dataLayer || [];
            window.gtag = window.gtag || function () {
                window.dataLayer.push(arguments);
            };

            window.gtag('js', new Date());
            window.gtag('config', ga4MeasurementId, {
                anonymize_ip: true,
                allow_google_signals: false,
                allow_ad_personalization_signals: false
            });

            const script = document.createElement('script');
            script.async = true;
            script.src = `https://www.googletagmanager.com/gtag/js?id=${encodeURIComponent(ga4MeasurementId)}`;
            document.head.appendChild(script);
            googleAnalyticsLoaded = true;
        }

        function disableGoogleAnalytics() {
            if (!ga4MeasurementId) return;
            window[`ga-disable-${ga4MeasurementId}`] = true;
            deleteMatchingCookies([/^_ga/, /^_gid/, /^_gat/]);
        }

        function loadMetaPixel() {
            if (!metaPixelId || metaPixelLoaded) return;

            window.fbq = window.fbq || function () {
                window.fbq.callMethod
                    ? window.fbq.callMethod.apply(window.fbq, arguments)
                    : window.fbq.queue.push(arguments);
            };

            if (!window._fbq) window._fbq = window.fbq;
            window.fbq.push = window.fbq;
            window.fbq.loaded = true;
            window.fbq.version = '2.0';
            window.fbq.queue = window.fbq.queue || [];
            window.fbq('init', metaPixelId);
            window.fbq('track', 'PageView');

            const script = document.createElement('script');
            script.async = true;
            script.src = 'https://connect.facebook.net/en_US/fbevents.js';
            document.head.appendChild(script);
            metaPixelLoaded = true;
        }

        function disableMetaPixel() {
            deleteMatchingCookies([/^_fbp/, /^_fbc/]);
        }

        return {
            setGoogleAnalyticsConsent(consent) {
                if (consent) {
                    loadGoogleAnalytics();
                } else {
                    disableGoogleAnalytics();
                }
            },
            setMetaPixelConsent(consent) {
                if (consent) {
                    loadMetaPixel();
                } else {
                    disableMetaPixel();
                }
            }
        };
    })();

    document.addEventListener('DOMContentLoaded', () => {
        const button = document.querySelector('[data-cookie-preferences]');
        if (!button) return;

        button.addEventListener('click', () => {
            if (window.klaro && typeof window.klaro.show === 'function') {
                window.klaro.show();
            }
        });
    });
</script>
