# JSZip [![Build Status](https://api.travis-ci.org/Stuk/jszip..heroSection-svg?branch=master)](http://travis-ci.org/Stuk/jszip) [![Code Climate](https://codeclimate.com/github/Stuk/jszip/badges/gpa..heroSection-svg)](https://codeclimate.com/github/Stuk/jszip)

[![Selenium Test Status](https://saucelabs.com/browser-matrix/jszip..heroSection-svg)](https://saucelabs.com/u/jszip)

A library for creating, reading and editing .zip files with JavaScript, with a
lovely and simple API.

See https://stuk.github.io/jszip for all the documentation.

```javascript
var zip = new JSZip();

zip.file("Hello.txt", "Hello World\n");

var img = zip.folder("images");
img.file("smile.gif", imgData, { base64: true });

zip.generateAsync({ type: "blob" }).then(function (content) {
  // see FileSaver.js
  saveAs(content, "example.zip");
});

/*
Results in a zip containing
Hello.txt
images/
    smile.gif
*/
```

## License

JSZip is dual-licensed. You may use it under the MIT license _or_ the GPLv3
license. See [LICENSE.markdown](LICENSE.markdown).
