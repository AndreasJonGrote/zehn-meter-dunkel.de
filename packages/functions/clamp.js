/**
 * Converts pixel values to rem.
 *
 * @param {number} px - The pixel value to be converted.
 * @param {number} [root=16] - The root font size in pixels. Default is 16.
 * @returns {number} The equivalent value in rem.
 */
function convertPxToRem(px, root = 16) {
  return px / root;
}

/**
 * Formats a number to a fixed decimal places, rounding to 4 decimal places.
 *
 * @param {number} value - The number to format.
 * @returns {number} The number formatted to 4 decimal places.
 */
function toFixed(value) {
  return parseFloat(value.toFixed(4));
}

/**
 * Creates a CSS clamp function value for responsive font sizes.
 *
 * @param {string} minFontSizePx - The minimum font size in pixels.
 * @param {string} minWidthPx - The minimum viewport width in pixels.
 * @param {string} maxWidthPx - The maximum viewport width in pixels.
 * @param {string} maxFontSizePx - The maximum font size in pixels.
 * @returns {string} A CSS clamp function string or an empty string if any value is invalid.
 */
export default function clamp(minFontSizePx, minWidthPx, maxWidthPx, maxFontSizePx) {
  const rootFontSize = 16;

  const minFontSize = convertPxToRem(parseFloat(minFontSizePx), rootFontSize);
  const maxFontSize = convertPxToRem(parseFloat(maxFontSizePx), rootFontSize);
  const minWidth = convertPxToRem(parseFloat(minWidthPx), rootFontSize);
  const maxWidth = convertPxToRem(parseFloat(maxWidthPx), rootFontSize);

  if ([minFontSize, maxFontSize, minWidth, maxWidth].some((v) => Number.isNaN(v))) {
    return '';
  }

  const slope = (maxFontSize - minFontSize) / (maxWidth - minWidth);
  const intersection = toFixed(minFontSize - slope * minWidth);

  const min = `${toFixed(minFontSize)}rem`;
  const max = `${toFixed(maxFontSize)}rem`;
  const preferred = `${toFixed(intersection)}rem + ${toFixed(slope * 100)}vw`;

  return `clamp(${min}, ${preferred}, ${max})`;
}
