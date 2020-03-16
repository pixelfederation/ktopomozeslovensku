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
<footer class="l-nav">
  <div class="footer__nav">
    <p class="footer__nav-item">©2020 KtopomozeSlovensku</p>
    <a href="#" class="footer__nav-item">Súkromie</a>
    <a href="#" class="footer__nav-item">Kontakt</a>
  </div>
  <div class="footer__share">
    <a href="#">
      <i class="icon-brand-facebook"></i>
    </a>
    <a href="#">
      <i class="icon-brand-twitter"></i>
    </a>
    <a href="#">
      <i class="icon-brand-instagram"></i>
    </a>
    <a href="#">
      <i class="icon-email-at"></i>
    </a>
  </div>
</footer>`;
