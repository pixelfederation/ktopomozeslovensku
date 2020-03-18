import '../public/static/css/public.css'

export default {
  title: 'Navigation',
};

export const Main = () => `
<div class="l-nav">
  <img src="/static/img/logo.svg" class="logo l-nav__logo" alt="Kto pomôže Slovensku" />

  <nav class="nav">
    <a href="#" class="nav__item is-active">O projekte</a>
    <a href="#" class="nav__item">Darujem</a>
    <a href="#" class="nav__item">Potrebujem pomoc</a>
  </nav>
</div>
`;

export const Footer = () => `
<div>
  <footer class="l-footer-nav">
    <div class="footer__nav">
      <p class="footer__nav-item">©2020 KtopomozeSlovensku</p>
      <a href="#" class="footer__nav-item">Súkromie</a>
      <a href="#" class="footer__nav-item">Kontakt</a>
    </div>
    <div class="footer__share">
      <a href="https://www.facebook.com/KtoPomozeSlovensku/" target="_blank">
        <i class="icon-brand-facebook"></i>
      </a>
      <a href="https://www.instagram.com/ktopomozeslovensku/" target="_blank">
        <i class="icon-brand-instagram"></i>
      </a>
    </div>
  </footer>

  <div class="footer-legal">
    <div class="footer-legal__inner">
      <i class="footer-legal__icon icon-certificate"></i>
      <p class="footer-legal__text">
        Iniciatíva Kto pomôže Slovensku aj účet SK268330000000290146711, Fio banka, a.s., pobočka zahraničnej banky bol preverený Odborom počítačovej kriminality Úradu kriminálnej polície Prezídia Policajného zboru Slovenskej republiky
      </p>
    </div>
  </div>
</div>`;

