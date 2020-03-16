import '../public/static/css/public.css'

export default {
  title: 'Components/Inputs',
};

export const TextInput = () => `
  <div style="display: flex; flex-direction: column; width: 200px">
    <label for="input-1" class="label label--above">Meno kontaktnej osoby</label>
    <input id="input-1" class="input" placeholder="Meno">
    <p></p>
    <label for="input-2" class="label label--above">Error</label>
    <input id="input-2" class="input is-error">
    <p></p>
    <label for="input-3" class="label label--above">Disabled</label>
    <input id="input-3" class="input" disabled>
  </div>
`;

export const TextInputSmall = () => `
  <div style="width: 300px">
    <input class="input input--small">
  </div>
`;

export const Checkbox = () => `
  <div style="display: flex; flex-direction: column; width: 200px">
    <label>
      <input type="checkbox" class="checkbox">
      Zaskrtni ma
    </label>
    <label>
      <input type="checkbox" class="checkbox" disabled>
      Nezaskrtnes ma
    </label>
  </div>
`

