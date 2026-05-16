window.klaroConfig = {
    version: 1,
    elementID: 'klaro',
    storageMethod: 'cookie',
    storageName: 'nexusvora_cookie_consent',
    htmlTexts: true,
    embedded: false,
    groupByPurpose: true,
    acceptAll: true,
    hideDeclineAll: false,
    hideLearnMore: false,
    noticeAsModal: false,
    default: false,
    mustConsent: false,
    lang: 'pt',
    translations: {
        pt: {
            privacyPolicyUrl: '/politica-privacidade',
            consentModal: {
                title: 'Preferências de cookies',
                description: 'Escolha que cookies não essenciais a NexusVora pode utilizar. Pode alterar esta escolha a qualquer momento.'
            },
            consentNotice: {
                description: 'Usamos cookies essenciais e, com o seu consentimento, cookies de analytics e marketing.',
                learnMore: 'Gerir preferências'
            },
            acceptAll: 'Aceitar todos',
            acceptSelected: 'Guardar preferências',
            decline: 'Recusar não essenciais',
            ok: 'Guardar',
            purposes: {
                essential: 'Essenciais',
                analytics: 'Analytics',
                marketing: 'Marketing'
            },
            googleAnalytics: {
                title: 'Google Analytics 4',
                description: 'Ajuda-nos a medir tráfego e desempenho do site.'
            },
            metaPixel: {
                title: 'Meta Pixel',
                description: 'Ajuda-nos a medir campanhas e eventos de marketing.'
            }
        }
    },
    services: [
        {
            name: 'essential',
            title: 'Cookies essenciais',
            purposes: ['essential'],
            required: true,
            default: true
        },
        {
            name: 'googleAnalytics',
            title: 'Google Analytics 4',
            purposes: ['analytics'],
            required: false,
            default: false,
            cookies: [/^_ga/, /^_gid/, /^_gat/],
            callback: function(consent) {
                if (window.NexusVoraConsent) {
                    window.NexusVoraConsent.setGoogleAnalyticsConsent(consent);
                }
            }
        },
        {
            name: 'metaPixel',
            title: 'Meta Pixel',
            purposes: ['marketing'],
            required: false,
            default: false,
            cookies: [/^_fbp/, /^_fbc/],
            callback: function(consent) {
                if (window.NexusVoraConsent) {
                    window.NexusVoraConsent.setMetaPixelConsent(consent);
                }
            }
        }
    ]
};
