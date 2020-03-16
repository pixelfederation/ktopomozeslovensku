import '../public/static/css/public.css'

export default {
  title: 'Components/Result',
};

export const Default = () => `
  <section class="result">
    <div class="result__stats">
      <p class="p1">Aktuálne sme spoločne prispeli</p>
      <p class="h1">3936,23 EUR</p>
    </div>

    <div class="result__buttons">
      <a href="#" class="button button--primary">Podporiť finančne</a>
      <a href="#" class="button button--secondary">Podporiť nefinančne</a>
    </div>

    <a href="#" class="result__share">
      <i class="icon-arrow-right" style="display: inline-block; transform: scale(1.5) translateY(1px);"></i> Pomôcť zdieľaním
    </a>
  </section>
`;

