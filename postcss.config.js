module.exports = (ctx) => ({
  map:  ctx.options.map,
  parser: ctx.options.parser,
  plugins: [
    require('postcss-hash')({
      algorithm: 'sha256',
      trim: 20,
      manifest: './public/manifest.json'
    }),
    require('autoprefixer'),
    require('cssnano')
  ]
});
