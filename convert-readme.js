const fs = require('fs');
const toWpTxt = require('@wpsh/to-wp-txt').default;

// Read the input README.md file
fs.readFile('README.md', 'utf8', (err, readmeContent) => {
  if (err) {
    console.error(err);
    return;
  }

  // Convert the Markdown content to WordPress readme.txt format
  const wpTxtContent = toWpTxt(readmeContent);

  // Write the output to readme.txt
  fs.writeFile('readme.txt', wpTxtContent, err => {
    if (err) {
      console.error(err);
      return;
    }
    console.log('Successfully converted README.md to readme.txt');
  });
});