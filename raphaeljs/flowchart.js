Raphael.fn.connection = function (obj1, obj2, line, bg) {
  if (obj1.line && obj1.from && obj1.to) {
    line = obj1;
    obj1 = line.from;
    obj2 = line.to;
  }
  var bb1 = obj1.getBBox(),
  bb2 = obj2.getBBox(),
  p = [{x: bb1.x + bb1.width / 2, y: bb1.y - 1},
  {x: bb1.x + bb1.width / 2, y: bb1.y + bb1.height + 1},
  {x: bb1.x - 1, y: bb1.y + bb1.height / 2},
  {x: bb1.x + bb1.width + 1, y: bb1.y + bb1.height / 2},
  {x: bb2.x + bb2.width / 2, y: bb2.y - 1},
  {x: bb2.x + bb2.width / 2, y: bb2.y + bb2.height + 1},
  {x: bb2.x - 1, y: bb2.y + bb2.height / 2},
  {x: bb2.x + bb2.width + 1, y: bb2.y + bb2.height / 2}],
  d = {}, dis = [];
  for (var i = 0; i < 4; i++) {
    for (var j = 4; j < 8; j++) {
      var dx = Math.abs(p[i].x - p[j].x),
      dy = Math.abs(p[i].y - p[j].y);
      if ((i == j - 4) || (((i != 3 && j != 6) || p[i].x < p[j].x) && ((i != 2 && j != 7) || p[i].x > p[j].x) && ((i != 0 && j != 5) || p[i].y > p[j].y) && ((i != 1 && j != 4) || p[i].y < p[j].y))) {
        dis.push(dx + dy);
        d[dis[dis.length - 1]] = [i, j];
      }
    }
  }
  var res = [1, 4];
    /*if (dis.length == 0) {
        var res = [0, 4];
    } else {
        res = d[Math.min.apply(Math, dis)];
      }*/
      var x1 = p[res[0]].x,
      y1 = p[res[0]].y,
      x4 = p[res[1]].x,
      y4 = p[res[1]].y;

      dx = Math.max(Math.abs(x1 - x4) / 2, 10);
      dy = Math.max(Math.abs(y1 - y4) / 2, 10);

      var x2 = [x1, x1, x1 - dx, x1 + dx][res[0]].toFixed(3),
      y2 = [y1 - dy, y1 + dy, y1, y1][res[0]].toFixed(3),
      x3 = [0, 0, 0, 0, x4, x4, x4 - dx, x4 + dx][res[1]].toFixed(3),
      y3 = [0, 0, 0, 0, y1 + dy, y1 - dy, y4, y4][res[1]].toFixed(3);
      var path = ["M", x1.toFixed(3), y1.toFixed(3), "C", x2, y2, x3, y3, x4.toFixed(3), y4.toFixed(3)].join(",");
      if (line && line.line) {
        line.bg && line.bg.attr({path: path});
        line.line.attr({path: path});
      } else {
        var color = typeof line == "string" ? line : "#000";
        return {
          bg: bg && bg.split && this.path(path).attr({stroke: bg.split("|")[0], fill: "none", "stroke-width": bg.split("|")[1] || 3}),
          line: this.path(path).attr({stroke: color, fill: "none"}),
          from: obj1,
          to: obj2
        };
      }
    };

    var el;
    window.onload = function () {
      var S, T1, T2, i, ii, att, x0, Dx, y0, Dy, T1space, T2space;
      x0 = 5;
      y0 = 5;
      Dx = 170;
      Dy = 100;
      T1space = 25;
      T2space = 65;


      var dragger = function () {
        this.ox = this.type == "ellipse" ? this.attr("cx") : this.attr("x");
        this.oy = this.type == "ellipse" ? this.attr("cy") : this.attr("y");
        if (this.type != "text") this.animate({"fill-opacity": .2}, 500);

        this.pair1.ox = this.pair1.type == "ellipse" ? this.pair1.attr("cx") : this.pair1.attr("x");
        this.pair1.oy = this.pair1.type == "ellipse" ? this.pair1.attr("cy") : this.pair1.attr("y");
        if (this.pair1.type != "text") this.pair1.animate({"fill-opacity": .2}, 500);

        this.pair2.ox = this.pair2.type == "ellipse" ? this.pair2.attr("cx") : this.pair2.attr("x");
        this.pair2.oy = this.pair2.type == "ellipse" ? this.pair2.attr("cy") : this.pair2.attr("y");
        if (this.pair2.type != "text") this.pair2.animate({"fill-opacity": .2}, 500);
      },
      move = function (dx, dy) {
        att = this.type == "ellipse" ? {cx: this.ox + dx, cy: this.oy + dy} : {x: this.ox + dx, y: this.oy + dy};
        this.attr(att);

        att = this.pair1.type == "ellipse" ? {cx: this.pair1.ox + dx, cy: this.pair1.oy + dy} : {x: this.pair1.ox + dx, y: this.pair1.oy + dy};
        this.pair1.attr(att);

        att = this.pair2.type == "ellipse" ? {cx: this.pair2.ox + dx, cy: this.pair2.oy + dy} : {x: this.pair2.ox + dx, y: this.pair2.oy + dy};
        this.pair2.attr(att);

        for (var i = connections.length; i--;) {
          r.connection(connections[i]);
        }
        r.safari();
      },
      up = function () {
        if (this.type != "text") this.animate({"fill-opacity": 0}, 500);

        if (this.pair1.type != "text") this.pair1.animate({"fill-opacity": 0}, 500);

        if (this.pair2.type != "text") this.pair2.animate({"fill-opacity": 0}, 500);
      },

      polydict = {"POLYN":"Polytope #\n(within H11)",
      "H11":"H11",
      "H21":"H21",
      "EULER":"Euler #",
      "FAV":"Favorable?",
      "NGEOMS":"# of Geometries\n(within polytope)",
      "NALLTRIANGS":"# of Triangulations\n(within polytope)",
      "FUNDGP":"Fundamental Group",
      "NNVERTS":"# of Newton\nPolytope Vertices",
      "NNPOINTS":"# of Newton\nPolytope Points",
      "NVERTS":"Newton Polytope\nVertex Matrix",
      "POLYID":"Polytope ID #",
      "NDVERTS":"# of Dual\nPolytope Vertices",
      "NDPOINTS":"# of Dual\nPolytope Points",
      "DVERTS":"Dual Polytope\nVertex Matrix",
      "DRESVERTS":"Dual Polytope\nResolved Vertex Matrix",
      "CWS":"Weight Matrix",
      "RESCWS":"Resolved Weight\nMatrix",
      "DTOJ":"Toric to Basis Divisor\nTransformation Matrix",
      "BASIS":"Basis from\nToric Divisors",
      "JTOD":"Basis to Toric Divisor\nTransformation Matrix",
      "INVBASIS":"Toric from\nBasis Divisors"},

      geomdict = {"NTRIANGS":"# of Triangulations\n(within geometry)",
      "IPOLYXJ":"CY Intersection\nPolynomial (Basis)",
      "ITENSXJ":"CY Intersection\nTensor (Basis)",
      "CHERN2XJ":"CY 2nd Chern\nClass (Basis)",
      "GEOMN":"Geometry #\n(within polytope)",
      "CHERN2XNUMS":"CY 2nd\nChern Numbers",
      "MORIMAT":"CY Mori Cone Matrix",
      "KAHLERMAT":"CY Kahler Cone\nMatrix",
      "SWISSCHEESE":"Swiss Cheese Solutions"},

      swisscheesedict = {"NLARGE":"# of Large Cycles",
      "RMAT2CYCLE":"2-Cycle\nRotation Matrix",
      "RMAT4CYCLE":"4-Cycle\nRotation Matrix",
      "INTBASIS2CYCLE":"2-Cycle Z-Basis?",
      "INTBASIS4CYCLE":"4-Cycle Z-Basis?"},

      triangdict = {"TRIANGN":"Triangulation #\n(within geometry)",
      "ALLTRIANGN":"Triangulation #\n(within polytope)",
      "TRIANG":"Triangulation",
      "SRIDEAL":"Stanley-Reisner Ideal",
      "CHERNAD":"Ambient Chern\nClasses (Toric)",
      "CHERNAJ":"Ambient Chern\nClasses (Basis)",
      "CHERN2XD":"CY 2nd Chern\nClass (Toric)",
      "CHERN3XD":"CY 3rd Chern\nClass (Toric)",
      "CHERN3XJ":"CY 3rd Chern\nClass (Basis)",
      "IPOLYAD":"Ambient\nIntersection\nPolynomial (Toric)",
      "ITENSAD":"Ambient\nIntersection\nTensor (Toric)",
      "IPOLYAJ":"Ambient\nIntersection\nPolynomial (Basis)",
      "ITENSAJ":"Ambient\nIntersection\nTensor (Basis)",
      "IPOLYXD":"CY Intersection\nPolynomial (Toric)",
      "ITENSXD":"CY Intersection\nTensor (Toric)",
      "MORIMATP":"Phase Mori\nCone Matrix",
      "KAHLERMATP":"Phase Kahler\nCone Matrix"},

      polylen = Object.keys(polydict).length,
      geomlen = Object.keys(geomdict).length,
      swisscheeselen = Object.keys(swisscheesedict).length,
      trianglen = Object.keys(triangdict).length,
      
      maxmod = Math.max(polylen,geomlen,swisscheeselen,trianglen),

      r = Raphael("holder",(2*x0)+(maxmod*Dx),(2*y0)+(7*Dy)),

      connections = [];

      /*var i=0,key,shapespoly=[],text1poly=[],text2poly=[],shapesgeom=[],text1geom=[],text2geom=[],shapestriang=[],text1triang=[],text2triang=[];
      for (key in polydict) {
        shapespoly.push(r.rect(x0 + (i+2) * Dx, y0, Dx, height, 0));
        text1poly.push(r.text(x0 + (Dx / 2) + (i+2) * Dx, y0 + 25, key));
        text2poly.push(r.text(x0 + (Dx / 2) + (i+2) * Dx, y0 + 65, polydict[key]));
        i++;
      }
      i=0;
      for (key in geomdict) {
        shapesgeom.push(r.rect(x0 + (i+4) * Dx + (i-4) * 20, y0 + Dy, Dx, height, 8));
        text1geom.push(r.text(x0 + (Dx / 2) + (i+4) * Dx + (i-4) * 20, y0 + Dy + 25, key));
        text2geom.push(r.text(x0 + (Dx / 2) + (i+4) * Dx + (i-4) * 20, y0 + Dy + 65, geomdict[key]));
        i++;
      }
      i=0;
      for (key in triangdict) {
        shapestriang.push(r.rect(x0 + (i+1) * Dx + (i-4) * 20, y0 + (2*Dy), Dx, height, 8));
        text1triang.push(r.text(x0 + (Dx / 2) + (i+1) * Dx + (i-4) * 20, y0 + (2*Dy) + 25, key));
        text2triang.push(r.text(x0 + (Dx / 2) + (i+1) * Dx + (i-4) * 20, y0 + (2*Dy) + 65, triangdict[key]));
        i++;
      }*/

      var i=0,key,shapespoly={},text1poly={},text2poly={},shapesgeom={},text1geom={},text2geom={},shapesswisscheese={},text1swisscheese={},text2swisscheese={},shapestriang={},text1triang={},text2triang={};
      for (key in polydict) {
        //var color = Raphael.getColor();
        var xpos=x0+((i+((maxmod-polylen)/2))*Dx);
        var ypos=y0;
        shapespoly[key]=r.rect(xpos, ypos, Dx, Dy, 0);
        shapespoly[key].attr({fill: "60-#FFF-#A8A8A8", stroke: "#E68A00", "fill-opacity": 0.8, "stroke-width": 8});
        text1poly[key]=r.text(xpos+(Dx/2), ypos+T1space, key);
        text1poly[key].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "sans-serif"});
        text2poly[key]=r.text(xpos+(Dx/2), ypos+T2space, polydict[key]);
        text2poly[key].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "serif"});
        i++;
      }
      i=0;
      for (key in geomdict) {
        //var color = Raphael.getColor();
        var xpos=x0+((i+((maxmod-geomlen)/2))*Dx);
        var ypos=y0+(2*Dy);
        shapesgeom[key]=r.rect(xpos, ypos, Dx, Dy, 8);
        S = shapesgeom[key].attr({fill: "60-#FFF-#A8A8A8", stroke: "#E68A00", "fill-opacity": 0.8, "stroke-width": 8, "z-index": String(i), cursor: "move"});
        text1geom[key]=r.text(xpos+(Dx/2), ypos+T1space, key);
        T1 = text1geom[key].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "sans-serif", "z-index": String(i), cursor: "move"});
        text2geom[key]=r.text(xpos+(Dx/2), ypos+T2space, geomdict[key]);
        T2 = text2geom[key].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "serif", "z-index": String(i), cursor: "move"});

        //Associate Elements
        S.pair1 = T1;
        S.pair2 = T2;
        T1.pair1 = S;
        T1.pair2 = T2;
        T2.pair1 = S;
        T2.pair2 = T1;

        shapesgeom[key].drag(move, dragger, up);
        text1geom[key].drag(move, dragger, up);
        text2geom[key].drag(move, dragger, up);

        connections.push(r.connection(shapespoly["POLYID"], shapesgeom[key], "#E68A00","#E68A00|5"));
        i++;
      }
      i=0;
      for (key in swisscheesedict) {
        //var xpos=x0+((i+((maxmod-swisscheeselen)/2))*Dx);
        var xpos=x0+((i+((maxmod+swisscheeselen)/2)+2.5)*Dx);
        var ypos=y0+(4*Dy);
        shapesswisscheese[key]=r.rect(xpos, ypos, Dx, Dy, 8);
        S = shapesswisscheese[key].attr({fill: "60-#FFF-#A8A8A8", stroke: "#E68A00", "fill-opacity": 0.8, "stroke-width": 8, "z-index": String(i), cursor: "move"});
        text1swisscheese[key]=r.text(xpos+(Dx/2), ypos+T1space, key);
        T1 = text1swisscheese[key].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "sans-serif", "z-index": String(i), cursor: "move"});
        text2swisscheese[key]=r.text(xpos+(Dx/2), ypos+T2space, swisscheesedict[key]);
        T2 = text2swisscheese[key].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "serif", "z-index": String(i), cursor: "move"});

        //Associate Elements
        S.pair1 = T1;
        S.pair2 = T2;
        T1.pair1 = S;
        T1.pair2 = T2;
        T2.pair1 = S;
        T2.pair2 = T1;

        shapesswisscheese[key].drag(move, dragger, up);
        text1swisscheese[key].drag(move, dragger, up);
        text2swisscheese[key].drag(move, dragger, up);

        connections.push(r.connection(shapesgeom["SWISSCHEESE"], shapesswisscheese[key], "#E68A00","#E68A00|5"));
        i++;
      }
      i=0;
      for (key in triangdict) {
        var xpos=x0+((i+((maxmod-trianglen)/2)-2.5)*Dx);
        var ypos=y0+(6*Dy);
        shapestriang[key]=r.rect(xpos, ypos, Dx, Dy, 8);
        S = shapestriang[key].attr({fill: "60-#FFF-#A8A8A8", stroke: "#E68A00", "fill-opacity": 0.8, "stroke-width": 8, "z-index": String(i), cursor: "move"});
        text1triang[key]=r.text(xpos+(Dx/2), ypos+T1space, key);
        T1 = text1triang[key].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "sans-serif", "z-index": String(i), cursor: "move"});
        text2triang[key]=r.text(xpos+(Dx/2), ypos+T2space, triangdict[key]);
        T2 = text2triang[key].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "serif", "z-index": String(i), cursor: "move"});

        //Associate Elements
        S.pair1 = T1;
        S.pair2 = T2;
        T1.pair1 = S;
        T1.pair2 = T2;
        T2.pair1 = S;
        T2.pair2 = T1;

        shapestriang[key].drag(move, dragger, up);
        text1triang[key].drag(move, dragger, up);
        text2triang[key].drag(move, dragger, up);

        connections.push(r.connection(shapesgeom["GEOMN"], shapestriang[key], "#E68A00","#E68A00|5"));
        i++;
      }


        /*shapespoly = [  r.rect(x0 + 0 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 1 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 2 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 3 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 4 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 5 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 6 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 7 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 8 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 9 * Dx, y0, Dx, 100, 0),

                       r.rect(x0 + 10 * Dx, y0, Dx, 100, 0),

                       r.rect(x0 + 11 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 12 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 13 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 14 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 15 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 16 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 17 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 18 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 19 * Dx, y0, Dx, 100, 0),
                       r.rect(x0 + 20 * Dx, y0, Dx, 100, 0)
                    ],

        text1poly = [  r.text(x0 + (Dx / 2) + 0 * Dx, y0 + 25, "_id"),
                           r.text(x0 + (Dx / 2) + 1 * Dx, y0 + 25, "H11"),
                           r.text(x0 + (Dx / 2) + 2 * Dx, y0 + 25, "H21"),
                           r.text(x0 + (Dx / 2) + 3 * Dx, y0 + 25, "EULER"),
                           r.text(x0 + (Dx / 2) + 4 * Dx, y0 + 25, "POLY"),
                           r.text(x0 + (Dx / 2) + 5 * Dx, y0 + 25, "GEOM"),
                           r.text(x0 + (Dx / 2) + 6 * Dx, y0 + 25, "FAV"),
                           r.text(x0 + (Dx / 2) + 7 * Dx, y0 + 25, "NVERTS"),
                           r.text(x0 + (Dx / 2) + 8 * Dx, y0 + 25, "DVERTS"),
                           r.text(x0 + (Dx / 2) + 9 * Dx, y0 + 25, "DRESVERTS"),

                           r.text(x0 + (Dx / 2) + 10 * Dx, y0 + 25, "TRIANGDATA"),

                           r.text(x0 + (Dx / 2) + 11 * Dx, y0 + 25, "CWS"),
                           r.text(x0 + (Dx / 2) + 12 * Dx, y0 + 25, "RESCWS"),
                           r.text(x0 + (Dx / 2) + 13 * Dx, y0 + 25, "NTRIANGS"),
                           r.text(x0 + (Dx / 2) + 14 * Dx, y0 + 25, "BASIS"),
                           r.text(x0 + (Dx / 2) + 15 * Dx, y0 + 25, "TDIVS"),
                           r.text(x0 + (Dx / 2) + 16 * Dx, y0 + 25, "CHERN2"),
                           r.text(x0 + (Dx / 2) + 17 * Dx, y0 + 25, "IPOLY"),
                           r.text(x0 + (Dx / 2) + 18 * Dx, y0 + 25, "ITENS"),
                           r.text(x0 + (Dx / 2) + 19 * Dx, y0 + 25, "MORIMAT"),
                           r.text(x0 + (Dx / 2) + 20 * Dx, y0 + 25, "KAHLERMAT")
                        ],

        text2poly = [  r.text(x0 + (Dx / 2) + 0 * Dx, y0 + 65, "ID"),
                           r.text(x0 + (Dx / 2) + 1 * Dx, y0 + 65, "H11"),
                           r.text(x0 + (Dx / 2) + 2 * Dx, y0 + 65, "H21"),
                           r.text(x0 + (Dx / 2) + 3 * Dx, y0 + 65, "Euler #"),
                           r.text(x0 + (Dx / 2) + 4 * Dx, y0 + 65, "Polytope #"),
                           r.text(x0 + (Dx / 2) + 5 * Dx, y0 + 65, "Geometry #"),
                           r.text(x0 + (Dx / 2) + 6 * Dx, y0 + 65, "Favorable?"),
                           r.text(x0 + (Dx / 2) + 7 * Dx, y0 + 65, "Newton Polytope\nVertex Matrix"),
                           r.text(x0 + (Dx / 2) + 8 * Dx, y0 + 65, "Dual Polytope\nVertex Matrix"),
                           r.text(x0 + (Dx / 2) + 9 * Dx, y0 + 65, "Dual Polytope\nResolved Vertex Matrix"),

                           r.text(x0 + (Dx / 2) + 10 * Dx, y0 + 65, "Triangulation\nProperties"),

                           r.text(x0 + (Dx / 2) + 11 * Dx, y0 + 65, "Weight Matrix"),
                           r.text(x0 + (Dx / 2) + 12 * Dx, y0 + 65, "Resolved Weight\nMatrix"),
                           r.text(x0 + (Dx / 2) + 13 * Dx, y0 + 65, "# of Triangulations"),
                           r.text(x0 + (Dx / 2) + 14 * Dx, y0 + 65, "Divisor Class Basis"),
                           r.text(x0 + (Dx / 2) + 15 * Dx, y0 + 65, "Toric Divisor Classes"),
                           r.text(x0 + (Dx / 2) + 16 * Dx, y0 + 65, "2nd Chern Class"),
                           r.text(x0 + (Dx / 2) + 17 * Dx, y0 + 65, "Intersection Polynomial"),
                           r.text(x0 + (Dx / 2) + 18 * Dx, y0 + 65, "Intersection Tensor"),
                           r.text(x0 + (Dx / 2) + 19 * Dx, y0 + 65, "Mori Cone Matrix"),
                           r.text(x0 + (Dx / 2) + 20 * Dx, y0 + 65, "Kahler Cone Matrix")
                        ],

        shapesgeom = [  r.rect(x0 + 6 * Dx + (-4) * 20, y0 + Dy, Dx, 100, 8),
                        r.rect(x0 + 7 * Dx + (-3) * 20, y0 + Dy, Dx, 100, 8),
                        r.rect(x0 + 8 * Dx + (-2) * 20, y0 + Dy, Dx, 100, 8),
                        r.rect(x0 + 9 * Dx + (-1) * 20, y0 + Dy, Dx, 100, 8),

                        r.rect(x0 + 10 * Dx, y0 + Dy, Dx, 100, 8),

                        r.rect(x0 + 11 * Dx + 1 * 20, y0 + Dy, Dx, 100, 8),
                        r.rect(x0 + 12 * Dx + 2 * 20, y0 + Dy, Dx, 100, 8),
                        r.rect(x0 + 13 * Dx + 3 * 20, y0 + Dy, Dx, 100, 8),
                        r.rect(x0 + 14 * Dx + 4 * 20, y0 + Dy, Dx, 100, 8),
                        r.rect(x0 + 15 * Dx + 5 * 20, y0 + Dy, Dx, 100, 8)
                     ],

        text1geom = [  r.text(x0 + (Dx / 2) + 6 * Dx + (-6) * 20, y0 + Dy + 25, "triang_id"),
                            r.text(x0 + (Dx / 2) + 7 * Dx + (-5) * 20, y0 + Dy + 25, "TRIANGN"),
                            r.text(x0 + (Dx / 2) + 8 * Dx + (-4) * 20, y0 + Dy + 25, "TRIANG"),
                            r.text(x0 + (Dx / 2) + 9 * Dx + (-3) * 20, y0 + Dy + 25, "SRIDEAL"),
                            r.text(x0 + (Dx / 2) + 10 * Dx + (-2) * 20, y0 + Dy + 25, "CHERNAMB"),
                            r.text(x0 + (Dx / 2) + 11 * Dx + (-1) * 20, y0 + Dy + 25, "CHERN3"),

                            r.text(x0 + (Dx / 2) + 12 * Dx, y0 + Dy + 25, "IPOLYXD"),

                            r.text(x0 + (Dx / 2) + 13 * Dx + 1 * 20, y0 + Dy + 25, "ITENSXD"),
                            r.text(x0 + (Dx / 2) + 12 * Dx + 2 * 20, y0 + Dy + 25, "IPOLYAMB"),
                            r.text(x0 + (Dx / 2) + 13 * Dx + 3 * 20, y0 + Dy + 25, "ITENSAMB"),
                            r.text(x0 + (Dx / 2) + 12 * Dx + 4 * 20, y0 + Dy + 25, "IPOLYAMBD"),
                            r.text(x0 + (Dx / 2) + 13 * Dx + 5 * 20, y0 + Dy + 25, "ITENSAMBD"),
                            r.text(x0 + (Dx / 2) + 14 * Dx + 6 * 20, y0 + Dy + 25, "MORIMATP"),
                            r.text(x0 + (Dx / 2) + 15 * Dx + 7 * 20, y0 + Dy + 25, "KAHLERMATP")
                         ],

        text2geom = [  r.text(x0 + (Dx / 2) + 6 * Dx + (-6) * 20, y0 + Dy + 65, "Triangulation ID"),
                            r.text(x0 + (Dx / 2) + 7 * Dx + (-5) * 20, y0 + Dy + 65, "Triangulation #"),
                            r.text(x0 + (Dx / 2) + 8 * Dx + (-4) * 20, y0 + Dy + 65, "Triangulation"),
                            r.text(x0 + (Dx / 2) + 9 * Dx + (-3) * 20, y0 + Dy + 65, "Stanley-Reisner Ideal"),
                            r.text(x0 + (Dx / 2) + 10 * Dx + (-2) * 20, y0 + Dy + 65, "Ambient Chern Classes"),
                            r.text(x0 + (Dx / 2) + 11 * Dx + (-1) * 20, y0 + Dy + 65, "3rd Chern Class"),

                            r.text(x0 + (Dx / 2) + 12 * Dx, y0 + Dy + 65, "Toric Intersection\nPolynomial"),

                            r.text(x0 + (Dx / 2) + 13 * Dx + 1 * 20, y0 + Dy + 65, "Toric Intersection\nTensor"),
                            r.text(x0 + (Dx / 2) + 12 * Dx + 2 * 20, y0 + Dy + 65, "Ambient Intersection\nPolynomial"),
                            r.text(x0 + (Dx / 2) + 13 * Dx + 3 * 20, y0 + Dy + 65, "Ambient Intersection\nTensor"),
                            r.text(x0 + (Dx / 2) + 12 * Dx + 4 * 20, y0 + Dy + 65, "Toric Ambient\nIntersection Polynomial"),
                            r.text(x0 + (Dx / 2) + 13 * Dx + 5 * 20, y0 + Dy + 65, "Toric Ambient\nIntersection Tensor"),
                            r.text(x0 + (Dx / 2) + 14 * Dx + 6 * 20, y0 + Dy + 65, "Mori Cone\nPhase Matrix"),
                            r.text(x0 + (Dx / 2) + 15 * Dx + 7 * 20, y0 + Dy + 65, "Kahler Cone\nPhase Matrix")
                            ];*/

      /*for (i = 0, ii = shapespoly.length; i < ii; i++) {
        //var color = Raphael.getColor();
        shapespoly[i].attr({fill: "60-#FFF-#A8A8A8", stroke: "#E68A00", "fill-opacity": 0.8, "stroke-width": 8});//, cursor: "move"});
        //shapes[i].drag(move, dragger, up);
        text1poly[i].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "sans-serif"})
        text2poly[i].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "serif"})
      }

      for (i = 0, ii = shapesgeom.length; i < ii; i++) {
        //var color = Raphael.getColor();
        S = shapesgeom[i].attr({fill: "60-#FFF-#A8A8A8", stroke: "#E68A00", "fill-opacity": 0.8, "stroke-width": 8, "z-index": String(i), cursor: "move"});
        T1 = text1geom[i].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "sans-serif", "z-index": String(i), cursor: "move"});
        T2 = text2geom[i].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "serif", "z-index": String(i), cursor: "move"});

        //Associate Elements
        S.pair1 = T1;
        S.pair2 = T2;
        T1.pair1 = S;
        T1.pair2 = T2;
        T2.pair1 = S;
        T2.pair2 = T1;

        shapesgeom[i].drag(move, dragger, up);
        text1geom[i].drag(move, dragger, up);
        text2geom[i].drag(move, dragger, up);
      }

      for (i = 0, ii = shapestriang.length; i < ii; i++) {
        //var color = Raphael.getColor();
        S = shapestriang[i].attr({fill: "60-#FFF-#A8A8A8", stroke: "#E68A00", "fill-opacity": 0.8, "stroke-width": 8, "z-index": String(i), cursor: "move"});
        T1 = text1triang[i].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "sans-serif", "z-index": String(i), cursor: "move"});
        T2 = text2triang[i].attr({fill: "#000", "font-size": "16px", "font-weight": "300", "font-family": "serif", "z-index": String(i), cursor: "move"});

        //Associate Elements
        S.pair1 = T1;
        S.pair2 = T2;
        T1.pair1 = S;
        T1.pair2 = T2;
        T2.pair1 = S;
        T2.pair2 = T1;

        shapestriang[i].drag(move, dragger, up);
        text1triang[i].drag(move, dragger, up);
        text2triang[i].drag(move, dragger, up);
      }*/

      /*connections.push(r.connection(shapespoly[11], shapesgeom[0], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapespoly[11], shapesgeom[1], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapespoly[11], shapesgeom[2], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapespoly[11], shapesgeom[3], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapespoly[11], shapesgeom[4], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapespoly[11], shapesgeom[5], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapespoly[11], shapesgeom[6], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapespoly[11], shapesgeom[7], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapespoly[11], shapesgeom[8], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapespoly[11], shapesgeom[9], "#E68A00","#E68A00|5"));

      connections.push(r.connection(shapesgeom[4], shapestriang[0], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[1], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[2], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[3], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[4], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[5], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[6], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[7], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[8], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[9], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[10], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[11], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[12], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[13], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[14], "#E68A00","#E68A00|5"));
      connections.push(r.connection(shapesgeom[4], shapestriang[15], "#E68A00","#E68A00|5"));*/
    };