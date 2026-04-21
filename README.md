<div align="center">

<img src="storage/app/public/images/logo/logo.png" alt="NexusVora Logo" width="400"/>

# ⚡ NexusVora

### Digital Agency · Web Development · AI Solutions

<p align="center">
  <a href="https://php.net"><img src="https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"></a>
  <a href="https://laravel.com"><img src="https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel"></a>
  <a href="https://tailwindcss.com"><img src="https://img.shields.io/badge/Tailwind-4.0-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS"></a>
  <a href="LICENSE"><img src="https://img.shields.io/badge/License-MIT-00D4FF?style=for-the-badge" alt="License"></a>
  <img src="https://img.shields.io/badge/Status-Em%20Desenvolvimento-8B3FDB?style=for-the-badge" alt="Status">
</p>

> **Transformação Digital · Performance Máxima · Soluções com IA**

<br/>

[🌐 Website](https://nexusvora.com) · [📧 Contacto](mailto:geral@nexusvora.com) · [💼 LinkedIn](https://www.linkedin.com/in/evinilson-fernandes/) · [📷 Instagram](https://instagram.com/nexusvora)

</div>

---

## 📋 Índice

- [Sobre o Projeto](#-sobre-o-projeto)
- [Serviços](#-serviços)
- [Stack Tecnológica](#-stack-tecnológica)
- [Design System](#-design-system)
- [Estrutura do Projeto](#-estrutura-do-projeto)
- [Páginas do Site](#-páginas-do-site)
- [Instalação Local](#-instalação-local)
- [Deploy](#-deploy)
- [Workflow de Desenvolvimento](#-workflow-de-desenvolvimento)
- [Configuração de Email](#-configuração-de-email)
- [Roadmap](#-roadmap)
- [Equipa](#-equipa)

---

## 🚀 Sobre o Projeto

A **NexusVora** é uma startup tecnológica portuguesa que combina serviços de marketing digital, desenvolvimento web e soluções empresariais com inteligência artificial. Mais do que uma agência — somos um parceiro estratégico de transformação digital para PMEs.

O nosso site institucional foi construído com **Laravel 12** e **Tailwind CSS 4**, com foco em performance extrema, SEO e uma estética dark mode premium que reflete a identidade da marca.

### ✨ Destaques

| Feature | Descrição |
|---------|-----------|
| 🌓 **Dark Mode Nativo** | Estética moderna e premium com paleta cyan/deep blue |
| ⚡ **Performance Extrema** | Otimizado para Core Web Vitals e carregamento ultra-rápido |
| 🔍 **SEO First** | Estrutura semântica pensada para ranking máximo no Google |
| 📱 **Mobile First** | Experiência fluida e consistente em todos os dispositivos |
| 🛠️ **Modern Workflow** | CI/CD automatizado e padrões de código de alta qualidade |
| 🔒 **Seguro** | Headers de segurança, CSRF protection e validação server-side |

---

## 🎯 Serviços

```
NexusVora
├── 🌐 Web Development
│   ├── Sites institucionais e landing pages
│   ├── E-commerce e lojas online
│   ├── Backoffice e áreas de cliente
│   └── Manutenção e suporte técnico
│
├── 📣 Marketing Digital
│   ├── Gestão de redes sociais
│   ├── Google Ads (Search, Display, Performance Max)
│   ├── Meta Ads (Facebook & Instagram)
│   └── SEO — Visibilidade orgânica duradoura
│
└── 🤖 Soluções Empresariais com IA
    ├── Automação de processos internos
    ├── Integração entre sistemas (ERP, e-commerce, faturação)
    ├── Chatbots e assistentes IA personalizados
    └── Dashboards e relatórios automáticos com IA
```

---

## 🛠️ Stack Tecnológica

### Backend
![PHP](https://img.shields.io/badge/PHP_8.4-777BB4?style=flat-square&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel_12-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL_8.0-4479A1?style=flat-square&logo=mysql&logoColor=white)

### Frontend
![Tailwind](https://img.shields.io/badge/Tailwind_4.0-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)
![Blade](https://img.shields.io/badge/Laravel_Blade-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=flat-square&logo=vite&logoColor=white)

### Infraestrutura
![Hetzner](https://img.shields.io/badge/Hetzner-D50C2D?style=flat-square&logo=hetzner&logoColor=white)
![Laravel Forge](https://img.shields.io/badge/Laravel_Forge-19224A?style=flat-square&logo=laravel&logoColor=white)
![GitHub](https://img.shields.io/badge/GitHub-181717?style=flat-square&logo=github&logoColor=white)

---

## 🎨 Design System

A identidade visual da NexusVora assenta numa paleta dark premium com acentos cyan e roxo.

| Token | Hex | Uso |
|-------|-----|-----|
| `--brand-primary` | `#00D4FF` | Cor principal, CTAs, links |
| `--brand-secondary` | `#4A6CF7` | Gradientes, destaques |
| `--brand-accent` | `#8B3FDB` | Acentos, badges, hover states |
| `--bg-base` | `#0A0F1E` | Fundo principal |
| `--bg-surface` | `#111827` | Cards e secções |
| `--text-primary` | `#F9FAFB` | Texto principal |
| `--text-muted` | `#6B7280` | Texto secundário e subtítulos |

---

## 🗂️ Estrutura do Projeto

```
nexusvora/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── ContactController.php    # Lógica do formulário de contacto
│   └── Mail/
│       └── ContactFormMail.php          # Template de email
│
├── design/                              # Assets de design (não incluídos no deploy)
│   ├── brand/
│   │   ├── logo-light.png
│   │   ├── logo-dark.png
│   │   ├── logo-icon.png
│   │   └── brand-guidelines.md
│   ├── pages/
│   │   ├── homepage/
│   │   ├── servicos/
│   │   ├── sobre-nos/
│   │   ├── portfolio/
│   │   └── contacto/
│   └── exports/
│       └── html/                        # Assets HTML/CSS exportados do design
│
├── docs/
│   ├── briefing.md                      # Briefing do projeto
│   ├── copy.md                          # Textos e copywriting
│   └── sitemap.md                       # Mapa do site
│
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php            # Layout base (navbar + footer)
│       ├── components/
│       │   ├── navbar.blade.php
│       │   ├── footer.blade.php
│       │   └── cta-banner.blade.php
│       └── pages/
│           ├── home.blade.php
│           ├── servicos.blade.php
│           ├── sobre.blade.php
│           ├── portfolio.blade.php
│           └── contacto.blade.php
│
├── routes/
│   └── web.php
│
└── public_html/
    ├── css/
    ├── js/
    └── images/
```

---

## 📄 Páginas do Site

| Página | Rota | Estado | Descrição |
|--------|------|--------|-----------|
| Homepage | `/` | ✅ Concluída | Hero, serviços, CTA, social proof |
| Serviços | `/servicos` | ✅ Concluída | Detalhe completo dos serviços e preços |
| Sobre Nós | `/sobre` | 🔄 Em desenvolvimento | Equipa, missão e valores |
| Portfólio | `/portfolio` | 🔄 Em desenvolvimento | Casos de sucesso e projetos entregues |
| Contacto | `/contacto` | 🔄 Em desenvolvimento | Formulário e informações de contacto |

---

## ⚙️ Instalação Local

### Pré-requisitos

- **PHP** 8.2+
- **Composer** 2+
- **MySQL** 8.0+
- **Laravel Herd** (recomendado) ou **Laravel Sail**

### Passo a Passo

```bash
# 1. Clonar o repositório
git clone https://github.com/Evinilson/NexusVora.git
cd NexusVora

# 2. Instalar dependências PHP
composer install

# 4. Configurar o ambiente
cp .env.example .env
php artisan key:generate

# 5. Configurar base de dados no .env
# DB_DATABASE=nexusvora
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Executar migrações
php artisan migrate

# 7. Iniciar servidor local
php artisan serve
```

> Acede em: **http://localhost:8000**

---

## 🚀 Deploy

O projeto é deployado automaticamente via **Laravel Forge** num servidor **Hetzner** (Frankfurt — baixa latência para Portugal e Europa).

### Build de Produção

```bash
# Otimizar Laravel para produção
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### Variáveis de Ambiente em Produção

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://nexusvora.com

DB_CONNECTION=mysql
DB_DATABASE=nexusvora_prod

CACHE_DRIVER=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

---

## 🔄 Workflow de Desenvolvimento

```
Briefing & Estratégia Inicial
            ↓
    Definição de Requisitos
            ↓
    Design & UI Generation
   Mockups Visuais + HTML/CSS
            ↓
    Desenvolvimento & Coding
  Implementação em Laravel/Blade
            ↓
  Revisão & QA Manual
            ↓
   GitHub — Pull Request
            ↓
Laravel Forge — Deploy Automático
            ↓
      ✅ Produção
```

---

## 📬 Configuração de Email

O formulário de contacto é o único elemento dinâmico do site. Configura no `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.exemplo.pt
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME=geral@nexusvora.com
MAIL_PASSWORD=
MAIL_FROM_ADDRESS=geral@nexusvora.com
MAIL_FROM_NAME="NexusVora"
```

---

## 🗺️ Roadmap

### Fase 1 — Site Institucional
- [x] Homepage
- [x] Página de Serviços
- [ ] Página Sobre Nós
- [ ] Portfólio
- [ ] Contacto com formulário funcional

### Fase 2 — Funcionalidades
- [ ] Blog / Artigos (SEO)
- [ ] Área de cliente
- [ ] Dashboard de relatórios para clientes
- [ ] Integração com CRM

### Fase 3 — Produtos SaaS
- [ ] **Vezinha** — Plataforma de agendamento para profissionais de beleza
- [ ] **Spaxlify** — Plataforma de design 3D

---

## 👥 Equipa

| Membro | Papel |
|--------|-------|
| **Evinilson Fernandes** | Co-Founder · Fullstack Developer |
| **Parceiro** | Co-Founder · Marketing & Comercial |

---

## 📞 Contacto

<div align="center">

| Canal | Link |
|-------|------|
| 🌍 Website | [nexusvora.com](https://nexusvora.com) |
| 📧 Email | [geral@nexusvora.com](mailto:geral@nexusvora.com) |
| 📍 Localização | Porto · Gaia · Maia — Portugal |
| 💼 LinkedIn | [linkedin.com/in/evinilson-fernandes](https://www.linkedin.com/in/evinilson-fernandes/) |
| 📷 Instagram | [@nexusvora](https://instagram.com/nexusvora) |

</div>

---

## 📝 Licença

© 2026 **NexusVora**. Todos os direitos reservados.

Este projeto é propriedade da NexusVora. O código fonte é disponibilizado sob a licença [MIT](LICENSE) para fins educativos.

---

<div align="center">

**Desenvolvido com ❤️ pela equipa NexusVora**

*Powered by [Laravel](https://laravel.com) · [Tailwind CSS](https://tailwindcss.com)*

</div>