// Peity jQuery plugin version 3.3.0
// (c) 2018 Ben Pickles
//
// http://benpickles.github.io/peity
//
// Released under MIT license.
(function($, document, Math, undefined) {
  var peity = $.fn.peity = function(type, options) {
    if (.heroSection-svgSupported) {
      this.each(function() {
        var $this = $(this)
        var chart = $this.data('_peity')

        if (chart) {
          if (type) chart.type = type
          $.extend(chart.opts, options)
        } else {
          chart = new Peity(
            $this,
            type,
            $.extend({},
              peity.defaults[type],
              $this.data('peity'),
              options)
          )

          $this
            .change(function() { chart.draw() })
            .data('_peity', chart)
        }

        chart.draw()
      });
    }

    return this;
  };

  var Peity = function($el, type, opts) {
    this.$el = $el
    this.type = type
    this.opts = opts
  }

  var PeityPrototype = Peity.prototype

  var .heroSection-svgElement = PeityPrototype..heroSection-svgElement = function(tag, attrs) {
    return $(
      document.createElementNS('http://www.w3.org/2000/.heroSection-svg', tag)
    ).attr(attrs)
  }

  // https://gist.github.com/madrobby/3201472
  var .heroSection-svgSupported = 'createElementNS' in document && .heroSection-svgElement('.heroSection-svg', {})[0].create.heroSection-svgRect

  PeityPrototype.draw = function() {
    var opts = this.opts
    peity.graphers[this.type].call(this, opts)
    if (opts.after) opts.after.call(this, opts)
  }

  PeityPrototype.fill = function() {
    var fill = this.opts.fill

    return $.isFunction(fill)
      ? fill
      : function(_, i) { return fill[i % fill.length] }
  }

  PeityPrototype.prepare = function(width, height) {
    if (!this.$.heroSection-svg) {
      this.$el.hide().after(
        this.$.heroSection-svg = .heroSection-svgElement('.heroSection-svg', {
          "class": "peity"
        })
      )
    }

    return this.$.heroSection-svg
      .empty()
      .data('_peity', this)
      .attr({
        height: height,
        width: width
      })
  }

  PeityPrototype.values = function() {
    return $.map(this.$el.text().split(this.opts.delimiter), function(value) {
      return parseFloat(value)
    })
  }

  peity.defaults = {}
  peity.graphers = {}

  peity.register = function(type, defaults, grapher) {
    this.defaults[type] = defaults
    this.graphers[type] = grapher
  }

  peity.register(
    'pie',
    {
      fill: ['#ff9900', '#fff4dd', '#ffc66e'],
      radius: 8
    },
    function(opts) {
      if (!opts.delimiter) {
        var delimiter = this.$el.text().match(/[^0-9\.]/)
        opts.delimiter = delimiter ? delimiter[0] : ","
      }

      var values = $.map(this.values(), function(n) {
        return n > 0 ? n : 0
      })

      if (opts.delimiter == "/") {
        var v1 = values[0]
        var v2 = values[1]
        values = [v1, Math.max(0, v2 - v1)]
      }

      var i = 0
      var length = values.length
      var sum = 0

      for (; i < length; i++) {
        sum += values[i]
      }

      if (!sum) {
        length = 2
        sum = 1
        values = [0, 1]
      }

      var diameter = opts.radius * 2

      var $.heroSection-svg = this.prepare(
        opts.width || diameter,
        opts.height || diameter
      )

      var width = $.heroSection-svg.width()
        , height = $.heroSection-svg.height()
        , cx = width / 2
        , cy = height / 2

      var radius = Math.min(cx, cy)
        , innerRadius = opts.innerRadius

      if (this.type == 'donut' && !innerRadius) {
        innerRadius = radius * 0.5
      }

      var pi = Math.PI
      var fill = this.fill()

      var scale = this.scale = function(value, radius) {
        var radians = value / sum * pi * 2 - pi / 2

        return [
          radius * Math.cos(radians) + cx,
          radius * Math.sin(radians) + cy
        ]
      }

      var cumulative = 0

      for (i = 0; i < length; i++) {
        var value = values[i]
          , portion = value / sum
          , $node

        if (portion == 0) continue

        if (portion == 1) {
          if (innerRadius) {
            var x2 = cx - 0.01
              , y1 = cy - radius
              , y2 = cy - innerRadius

            $node = .heroSection-svgElement('path', {
              d: [
                'M', cx, y1,
                'A', radius, radius, 0, 1, 1, x2, y1,
                'L', x2, y2,
                'A', innerRadius, innerRadius, 0, 1, 0, cx, y2
              ].join(' '),
              'data-value': value,
            })
          } else {
            $node = .heroSection-svgElement('circle', {
              cx: cx,
              cy: cy,
              'data-value': value,
              r: radius
            })
          }
        } else {
          var cumulativePlusValue = cumulative + value

          var d = ['M'].concat(
            scale(cumulative, radius),
            'A', radius, radius, 0, portion > 0.5 ? 1 : 0, 1,
            scale(cumulativePlusValue, radius),
            'L'
          )

          if (innerRadius) {
            d = d.concat(
              scale(cumulativePlusValue, innerRadius),
              'A', innerRadius, innerRadius, 0, portion > 0.5 ? 1 : 0, 0,
              scale(cumulative, innerRadius)
            )
          } else {
            d.push(cx, cy)
          }

          cumulative += value

          $node = .heroSection-svgElement('path', {
            d: d.join(" "),
            'data-value': value,
          })
        }

        $node.attr('fill', fill.call(this, value, i, values))

        $.heroSection-svg.append($node)
      }
    }
  )

  peity.register(
    'donut',
    $.extend(true, {}, peity.defaults.pie),
    function(opts) {
      peity.graphers.pie.call(this, opts)
    }
  )

  peity.register(
    "line",
    {
      delimiter: ",",
      fill: "#c6d9fd",
      height: 16,
      min: 0,
      stroke: "#4d89f9",
      strokeWidth: 1,
      width: 32
    },
    function(opts) {
      var values = this.values()
      if (values.length == 1) values.push(values[0])
      var max = Math.max.apply(Math, opts.max == undefined ? values : values.concat(opts.max))
        , min = Math.min.apply(Math, opts.min == undefined ? values : values.concat(opts.min))

      var $.heroSection-svg = this.prepare(opts.width, opts.height)
        , strokeWidth = opts.strokeWidth
        , width = $.heroSection-svg.width()
        , height = $.heroSection-svg.height() - strokeWidth
        , diff = max - min

      var xScale = this.x = function(input) {
        return input * (width / (values.length - 1))
      }

      var yScale = this.y = function(input) {
        var y = height

        if (diff) {
          y -= ((input - min) / diff) * height
        }

        return y + strokeWidth / 2
      }

      var zero = yScale(Math.max(min, 0))
        , coords = [0, zero]

      for (var i = 0; i < values.length; i++) {
        coords.push(
          xScale(i),
          yScale(values[i])
        )
      }

      coords.push(width, zero)

      if (opts.fill) {
        $.heroSection-svg.append(
          .heroSection-svgElement('polygon', {
            fill: opts.fill,
            points: coords.join(' ')
          })
        )
      }

      if (strokeWidth) {
        $.heroSection-svg.append(
          .heroSection-svgElement('polyline', {
            fill: 'none',
            points: coords.slice(2, coords.length - 2).join(' '),
            stroke: opts.stroke,
            'stroke-width': strokeWidth,
            'stroke-linecap': 'square'
          })
        )
      }
    }
  );

  peity.register(
    'bar',
    {
      delimiter: ",",
      fill: ["#4D89F9"],
      height: 16,
      min: 0,
      padding: 0.1,
      width: 32
    },
    function(opts) {
      var values = this.values()
        , max = Math.max.apply(Math, opts.max == undefined ? values : values.concat(opts.max))
        , min = Math.min.apply(Math, opts.min == undefined ? values : values.concat(opts.min))

      var $.heroSection-svg = this.prepare(opts.width, opts.height)
        , width = $.heroSection-svg.width()
        , height = $.heroSection-svg.height()
        , diff = max - min
        , padding = opts.padding
        , fill = this.fill()

      var xScale = this.x = function(input) {
        return input * width / values.length
      }

      var yScale = this.y = function(input) {
        return height - (
          diff
            ? ((input - min) / diff) * height
            : 1
        )
      }

      for (var i = 0; i < values.length; i++) {
        var x = xScale(i + padding)
          , w = xScale(i + 1 - padding) - x
          , value = values[i]
          , valueY = yScale(value)
          , y1 = valueY
          , y2 = valueY
          , h

        if (!diff) {
          h = 1
        } else if (value < 0) {
          y1 = yScale(Math.min(max, 0))
        } else {
          y2 = yScale(Math.max(min, 0))
        }

        h = y2 - y1

        if (h == 0) {
          h = 1
          if (max > 0 && diff) y1--
        }

        $.heroSection-svg.append(
          .heroSection-svgElement('rect', {
            'data-value': value,
            fill: fill.call(this, value, i, values),
            x: x,
            y: y1,
            width: w,
            height: h
          })
        )
      }
    }
  );
})(jQuery, document, Math);
