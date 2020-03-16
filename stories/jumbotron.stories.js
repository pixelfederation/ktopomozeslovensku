import '../public/static/css/public.css'

export default {
  title: 'Components/Jumbotron',
};

export const Default = () => `
  <div class="jumbotron">
    <div class="jumbotron__inner">
      <h1 class="jumbotron__heading">Pomôžte zdielaním</h1>

      <div class="jumbotron__sharing">
        <a href="#" class="button button--ternary button--narrow button--with-icon">
          <i class="icon-brand-facebook"></i>Facebook</a>
        <a href="#" class="button button--ternary button--narrow button--with-icon">
          <i class="icon-brand-twitter"></i>Twitter</a>
        <a href="#" class="button button--ternary button--narrow button--with-icon">
          <i class="icon-brand-instagram"></i>Instagram</a>
        <a href="#" class="button button--ternary button--narrow button--with-icon">
          <i class="icon-email-at"></i>Email</a>
      </div>
    </div>
  </div>
`;
