#!/usr/bin/env python3
"""Generate the NexusVora security-audit PDF (pt-BR)."""

from datetime import date
from pathlib import Path

from reportlab.lib import colors
from reportlab.lib.enums import TA_CENTER, TA_LEFT
from reportlab.lib.pagesizes import A4
from reportlab.lib.styles import ParagraphStyle, getSampleStyleSheet
from reportlab.lib.units import cm
from reportlab.pdfbase.pdfmetrics import stringWidth
from reportlab.platypus import (
    KeepTogether,
    PageBreak,
    Paragraph,
    SimpleDocTemplate,
    Spacer,
    Table,
    TableStyle,
)
from reportlab.graphics.shapes import Circle, Drawing, Line, Rect, String

ROOT = Path(__file__).resolve().parent
OUT = ROOT / "relatorio-auditoria-seguranca.pdf"

NAVY = colors.HexColor("#0B1220")
INK = colors.HexColor("#172033")
MUTED = colors.HexColor("#5B667A")
PALE = colors.HexColor("#F4F7FB")
BORDER = colors.HexColor("#D8E0EB")
CRITICAL = colors.HexColor("#B91C1C")
HIGH = colors.HexColor("#EA580C")
MEDIUM = colors.HexColor("#D97706")
LOW = colors.HexColor("#2563EB")
STRONG = colors.HexColor("#059669")


def esc(value: str) -> str:
    return value.replace("&", "&amp;").replace("<", "&lt;").replace(">", "&gt;")


def footer(canvas, doc):
    canvas.saveState()
    canvas.setStrokeColor(BORDER)
    canvas.line(doc.leftMargin, 1.35 * cm, A4[0] - doc.rightMargin, 1.35 * cm)
    canvas.setFont("Helvetica", 8)
    canvas.setFillColor(MUTED)
    canvas.drawString(doc.leftMargin, 0.82 * cm, "Relatório de Auditoria de Segurança — NexusVora")
    page = f"Página {doc.page}"
    canvas.drawRightString(A4[0] - doc.rightMargin, 0.82 * cm, page)
    canvas.restoreState()


def donut():
    d = Drawing(230, 150)
    d.add(Circle(75, 78, 51, fillColor=STRONG, strokeColor=STRONG))
    d.add(Circle(75, 78, 30, fillColor=colors.white, strokeColor=colors.white))
    d.add(String(75, 82, "0", fontName="Helvetica-Bold", fontSize=23, fillColor=INK, textAnchor="middle"))
    d.add(String(75, 63, "achados", fontName="Helvetica", fontSize=9, fillColor=MUTED, textAnchor="middle"))
    labels = [("Crítica", 0, CRITICAL), ("Alta", 0, HIGH), ("Média", 0, MEDIUM), ("Baixa", 0, LOW)]
    y = 113
    for label, count, color in labels:
        d.add(Rect(135, y - 4, 8, 8, fillColor=color, strokeColor=color))
        d.add(String(150, y - 3, f"{label}: {count}", fontName="Helvetica", fontSize=9, fillColor=INK))
        y -= 22
    return d


def bars():
    d = Drawing(260, 150)
    rows = [
        ("Banco sem tranca", 0),
        ("Permissão no navegador", 0),
        ("IDOR", 0),
        ("Chaves expostas", 0),
        ("XSS / inputs", 0),
    ]
    x0, y0, maxw = 115, 122, 105
    for i, (label, count) in enumerate(rows):
        y = y0 - i * 23
        d.add(String(0, y + 1, label, fontName="Helvetica", fontSize=8.5, fillColor=INK))
        d.add(Rect(x0, y - 5, maxw, 10, fillColor=PALE, strokeColor=BORDER, strokeWidth=.4))
        d.add(String(x0 + maxw + 10, y - 1, str(count), fontName="Helvetica-Bold", fontSize=9, fillColor=STRONG))
    d.add(String(0, 10, "Nenhuma categoria teve achado confirmado nesta revisão.", fontName="Helvetica-Oblique", fontSize=8.5, fillColor=MUTED))
    return d


def chip(text, color):
    return Paragraph(f'<font color="{color.hexval()}"><b>{esc(text)}</b></font>', styles["chip"])


styles = getSampleStyleSheet()
styles.add(ParagraphStyle(name="TitleCustom", parent=styles["Title"], fontName="Helvetica-Bold", fontSize=25, leading=31, textColor=NAVY, spaceAfter=10))
styles.add(ParagraphStyle(name="Subtitle", parent=styles["BodyText"], fontName="Helvetica", fontSize=12, leading=18, textColor=MUTED))
styles.add(ParagraphStyle(name="H1Custom", parent=styles["Heading1"], fontName="Helvetica-Bold", fontSize=17, leading=22, textColor=NAVY, spaceBefore=12, spaceAfter=8))
styles.add(ParagraphStyle(name="H2Custom", parent=styles["Heading2"], fontName="Helvetica-Bold", fontSize=12, leading=16, textColor=INK, spaceBefore=8, spaceAfter=5))
styles.add(ParagraphStyle(name="BodyCustom", parent=styles["BodyText"], fontName="Helvetica", fontSize=9.3, leading=14, textColor=INK, spaceAfter=6))
styles.add(ParagraphStyle(name="Small", parent=styles["BodyText"], fontName="Helvetica", fontSize=8.2, leading=11, textColor=INK))
styles.add(ParagraphStyle(name="SmallWhite", parent=styles["BodyText"], fontName="Helvetica-Bold", fontSize=8.2, leading=11, textColor=colors.white))
styles.add(ParagraphStyle(name="chip", parent=styles["BodyText"], fontName="Helvetica", fontSize=8, leading=10, alignment=TA_CENTER))
styles.add(ParagraphStyle(name="Issue", parent=styles["Code"], fontName="Courier", fontSize=7.2, leading=9.5, textColor=INK))


def p(text, style="BodyCustom"):
    return Paragraph(text, styles[style])


def section(title):
    return [Spacer(1, 2), p(title, "H1Custom")]


def build():
    doc = SimpleDocTemplate(
        str(OUT), pagesize=A4, rightMargin=2 * cm, leftMargin=2 * cm,
        topMargin=1.8 * cm, bottomMargin=2 * cm,
        title="Relatório de Auditoria de Segurança — NexusVora",
        author="Codex Security Audit",
    )
    story = []
    story += [Spacer(1, 3.5 * cm), p("RELATÓRIO", "Subtitle"), p("Auditoria de Segurança — NexusVora", "TitleCustom")]
    story += [p(f"Data: {date.today().strftime('%d/%m/%Y')}", "Subtitle"), Spacer(1, .7 * cm)]
    story += [p("Escopo auditado", "H2Custom"), p("Repositório NexusVora, com rotas HTTP, controladores, modelos Eloquent, middleware, views Blade, e-mails, configurações, migrações, arquivos de deploy presentes e histórico Git. Dependências de terceiros em <i>vendor/</i> não foram tratadas como código do produto.")]
    story += [p("Nota metodológica", "H2Custom"), p("Stack detectada: PHP 8.2, Laravel 12, Eloquent ORM, autenticação por sessão do Laravel e autorização por middleware <font name=\"Courier\">auth</font> + <font name=\"Courier\">admin</font>. Não existe modelo de usuário final, organização ou tenant: o painel é um único domínio administrativo. Assim, isolamento foi mapeado ao acesso administrativo global; IDOR foi verificado em todos os parâmetros de rota com model binding e recursos aninhados; XSS foi mapeado a Blade, e-mails e JavaScript; segredos foram buscados no estado atual e no histórico Git.")]
    story += [Spacer(1, .8 * cm), p("Resultado: nenhum achado confirmado", "H2Custom"), p("A solicitação exigia reporte apenas de falhas comprovadas. A revisão não encontrou falha explorável nas cinco categorias solicitadas. Portanto, o relatório não força cinco achados artificiais.")]
    story.append(PageBreak())

    story += section("Resumo executivo")
    summary = Table([
        [donut(), bars()],
        [p("<b>Severidade</b><br/>Crítica 0 · Alta 0 · Média 0 · Baixa 0", "Small"), p("<b>Cobertura</b><br/>63 rotas registradas; todos os handlers próprios e os sinks de renderização relevantes revisados.", "Small")],
    ], colWidths=[8.2 * cm, 8.6 * cm])
    summary.setStyle(TableStyle([("VALIGN", (0, 0), (-1, -1), "TOP"), ("BOX", (0, 0), (-1, -1), .5, BORDER), ("INNERGRID", (0, 0), (-1, -1), .4, BORDER), ("BACKGROUND", (0, 1), (-1, -1), PALE), ("LEFTPADDING", (0, 0), (-1, -1), 8), ("RIGHTPADDING", (0, 0), (-1, -1), 8), ("TOPPADDING", (0, 0), (-1, -1), 8), ("BOTTOMPADDING", (0, 0), (-1, -1), 8)]))
    story += [summary]
    story += section("Pontos fortes verificados")
    strengths = [
        ("Autorização no servidor", "routes/web.php:92-128 aplica auth + admin a todas as rotas do console; app/Http/Middleware/EnsureUserIsAdmin.php:14-16 bloqueia sessão ausente e usuários sem is_admin."),
        ("Cobertura de objetos aninhados", "ProjectController.php:106-143 confere que a tarefa pertence ao projeto; HourPackageController.php:131-134 e 156-158 conferem os vínculos entrada/pacote e tarefa/pacote."),
        ("Compartilhamento protegido", "SecureShare usa token aleatório de 48 caracteres (SecureShare.php:32-39), hash para o código de acesso (65-68), criptografia em repouso dos dados compartilhados (25-30) e valida expiração (SecureShareAccessController.php:38-46)."),
        ("XSS tratado no conteúdo de e-mail", "resources/views/emails/contact.blade.php:19 escapa a mensagem com e() antes de aplicar nl2br; Blade usa escape padrão nos demais campos revisados."),
        ("Segredos fora do Git", ".env está ignorado e não é rastreado; nenhuma assinatura de chave privada ou token de serviço foi encontrada no código do produto ou no histórico Git."),
    ]
    for title, evidence in strengths:
        story += [p(f"<font color=\"#059669\"><b>●</b></font> <b>{title}.</b> {evidence}")]

    story += section("Pontos fracos e recomendações preventivas")
    story += [p("Não há vulnerabilidade confirmada nesta revisão. As melhorias abaixo são preventivas e não representam achados acionáveis."),
              p("<b>P1.</b> Adicionar testes de feature para as rotas administrativas, especialmente a negação a usuário autenticado sem <font name=\"Courier\">is_admin</font> e a checagem de recursos aninhados."),
              p("<b>P2.</b> Se o produto evoluir para múltiplos operadores, introduzir <font name=\"Courier\">organization_id</font> ou políticas por dono antes de conceder papéis não administrativos; o modelo atual é global por projeto."),
              p("<b>P3.</b> Manter validação de URL na criação de compartilhamento seguro e considerar permitir somente <font name=\"Courier\">https</font> se links HTTP não forem necessários.")]
    story.append(PageBreak())

    story += section("Detalhamento por categoria")
    rows = [[p("Categoria", "SmallWhite"), p("Resultado", "SmallWhite"), p("Evidência de cobertura", "SmallWhite")],
            [p("Banco sem tranca", "Small"), chip("CORRETO / não aplicável", STRONG), p("Não há tenant, workspace ou usuário final modelado. O único escopo protegido é o console administrativo global, servido por auth + admin.", "Small")],
            [p("Permissão definida no navegador", "Small"), chip("CORRETO", STRONG), p("Não há gates de papel no frontend. As operações privilegiadas são guardadas no backend por routes/web.php:92-128 e EnsureUserIsAdmin.php:14-16.", "Small")],
            [p("IDOR", "Small"), chip("CORRETO", STRONG), p("Todos os handlers com ID foram percorridos. Bindings do console exigem admin; recursos aninhados validam pertencimento onde há relação pai-filho.", "Small")],
            [p("Chaves expostas", "Small"), chip("CORRETO", STRONG), p("Busca no código, configs, documentação, arquivos públicos e histórico Git não confirmou segredo hardcoded. .env é ignorado e fica fora de public_html.", "Small")],
            [p("Inputs sem tratamento / XSS", "Small"), chip("CORRETO", STRONG), p("Não há HTML bruto de entrada do usuário. O único raw output de mensagem usa e(); URLs compartilhadas são validadas como url antes de renderizar em href.", "Small")]]
    table = Table(rows, colWidths=[3.2 * cm, 3.2 * cm, 10.4 * cm], repeatRows=1)
    table.setStyle(TableStyle([("BACKGROUND", (0, 0), (-1, 0), NAVY), ("TEXTCOLOR", (0, 0), (-1, 0), colors.white), ("GRID", (0, 0), (-1, -1), .45, BORDER), ("VALIGN", (0, 0), (-1, -1), "TOP"), ("ROWBACKGROUNDS", (0, 1), (-1, -1), [colors.white, PALE]), ("LEFTPADDING", (0, 0), (-1, -1), 7), ("RIGHTPADDING", (0, 0), (-1, -1), 7), ("TOPPADDING", (0, 0), (-1, -1), 7), ("BOTTOMPADDING", (0, 0), (-1, -1), 7)]))
    story += [table, Spacer(1, .4 * cm), p("Tabela de achados: não aplicável - não há achados confirmados para listar.")]
    story += section("Cobertura e condições de explorabilidade")
    story += [p("A análise considerou as 63 rotas reportadas por <font name=\"Courier\">php artisan route:list</font>, todos os controladores em <font name=\"Courier\">app/Http/Controllers</font>, modelos, middleware, e-mails, views Blade, JavaScript próprio, migrações e configurações. O repositório estava com alterações locais preexistentes; elas foram apenas lidas e não modificadas."),
              p("A rota pública de compartilhamento é deliberadamente acessível por token. O token é de alta entropia e o conteúdo só é mostrado após código de acesso e antes da expiração. A limitação de tentativas por IP está em routes/web.php:57-59.")]
    story.append(PageBreak())

    story += section("ISSUES PARA O GITHUB")
    story += [p("Não há issues acionáveis: nenhum achado confirmado atingiu o limiar de reporte. Para preservar a regra de não criar spam, nenhum bloco de issue é incluído.")]
    story += [Spacer(1, .5 * cm), p("--- ISSUE 0 ---", "Issue"), p("Nenhuma issue gerada. A auditoria não confirmou falhas nas categorias solicitadas.", "Issue"), p("--- FIM ISSUE 0 ---", "Issue")]
    doc.build(story, onFirstPage=footer, onLaterPages=footer)


if __name__ == "__main__":
    build()
    print(OUT)
