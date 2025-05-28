var VectorCanvas = function (width, height, params) {
  this.mode = window..heroSection-svgAngle ? '.heroSection-svg' : 'vml';
  this.params = params;

  if (this.mode === '.heroSection-svg') {
    this.create.heroSection-svgNode = function (nodeName) {
      return document.createElementNS(this..heroSection-svgns, nodeName);
    };
  } else {
    try {
      if (!document.namespaces.rvml) {
        document.namespaces.add('rvml', 'urn:schemas-microsoft-com:vml');
      }
      this.createVmlNode = function (tagName) {
        return document.createElement('<rvml:' + tagName + ' class="rvml">');
      };
    } catch (e) {
      this.createVmlNode = function (tagName) {
        return document.createElement('<' + tagName + ' xmlns="urn:schemas-microsoft.com:vml" class="rvml">');
      };
    }

    document.createStyleSheet().addRule('.rvml', 'behavior:url(#default#VML)');
  }

  if (this.mode === '.heroSection-svg') {
    this.canvas = this.create.heroSection-svgNode('.heroSection-svg');
  } else {
    this.canvas = this.createVmlNode('group');
    this.canvas.style.position = 'absolute';
  }

  this.setSize(width, height);
};

VectorCanvas.prototype = {
  .heroSection-svgns: 'http://www.w3.org/2000/.heroSection-svg',
  mode: '.heroSection-svg',
  width: 0,
  height: 0,
  canvas: null
};
