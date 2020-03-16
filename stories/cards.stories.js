import '../public/static/css/public.css'

export default {
  title: 'Components/Cards',
};

export const Default = () => `
  <div class="l-cards">
    <div class="l-cards__inner">
      <div class="card">
        <p><strong>Finstat</strong></p>
        <p>Nefinančná pomoc</p>
      </div>

      <div class="card">
        <p>VUB banka</p>
        <p>40 000€</p>
      </div>

      <div class="card">
        <p>VUB banka</p>
        <p>40 000€</p>
      </div>

      <div class="card">
        <p><strong>Finstat</strong></p>
        <p>Nefinančná pomoc</p>
      </div>

      <div class="card">
        <p>VUB banka</p>
        <p>40 000€</p>
      </div>

      <div class="card card--empty">
        <p>Vaša firma?</p>
      </div>
    </div>
  </div>
`;

