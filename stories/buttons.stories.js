import '../public/static/css/public.css'

export default {
  title: 'Components/Buttons',
};

export const Primary = () => `
  <div style="display: grid; grid-template-columns: 200px; grid-row-gap: 20px">
    <button class="button button--primary">Try for free (button)</button>
    <a href="#" class="button button--primary">Try for free (a)</a>
  </div>
`;

export const PrimarySmall = () => `
  <div style="display: grid; grid-template-columns: 200px; grid-row-gap: 20px">
    <button class="button button--primary button--small">Try for free (button)</button>
    <a href="#" class="button button--primary button--small">Try for free (a)</a>
  </div>
`;

export const Secondary = () => `
  <div style="display: grid; grid-template-columns: 200px; grid-row-gap: 20px">
    <button class="button button--secondary">Try for free (button)</button>
    <a href="#" class="button button--secondary">Try for free (a)</a>
  </div>
`;

export const SecondarySmall = () => `
  <div style="display: grid; grid-template-columns: 200px; grid-row-gap: 20px">
    <button class="button button--secondary button--small">Try for free (button)</button>
    <a href="#" class="button button--secondary button--small">Try for free (a)</a>
  </div>
`;

export const Ternary = () => `
  <div style="display: grid; grid-template-columns: 300px; grid-row-gap: 20px; background: #940000">
    <button class="button button--ternary">Try for free (button)</button>
    <a href="#" class="button button--ternary">Try for free (a)</a>
  </div>
`;
