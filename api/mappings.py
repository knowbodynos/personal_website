TABLES = {
    "POLY": "Polytopes",
    "GEOM": "Geometries",
    "TORIC_SWISSCHEESE": "Toric Swiss Cheese Geometries",
    "EXPLICIT_SWISSCHEESE": "Explicit Swiss Cheese Geometries",
    "TRIANG": "Triangulations",
    "INVOL": "Involutions"
}


POLY = {
    "POLYID": "Polytope ID #",
    "POLYN": "Polytope # (within H11)",
    "H11": "H11",
    "H21": "H21",
    "EULER": "Euler #",
    "FAV": "Favorable?",
    "NGEOMS": "# of Geometries (within polytope)",
    "NALLTRIANGS": "# of Triangulations (within polytope)",
    "FUNDGP": "Fundamental Group",
    "NNVERTS": "# of Newton Polytope Vertices",
    "NNPOINTS": "# of Newton Polytope Points",
    "NVERTS": "Newton Polytope Vertex Matrix",
    "NDVERTS": "# of Dual Polytope Vertices",
    "NDPOINTS": "# of Dual Polytope Points",
    "DVERTS": "Dual Polytope Vertex Matrix",
    "DRESVERTS": "Dual Polytope Resolved Vertex Matrix",
    "CWS": "Weight Matrix",
    "RESCWS": "Resolved Weight Matrix",
    "DTOJ": "Toric to Basis Divisor Transformation Matrix",
    "BASIS": "Basis from Toric Divisors",
    "JTOD": "Basis to Toric Divisor Transformation Matrix",
    "INVBASIS": "Toric from Basis Divisors"
}


GEOM = {
    "GEOMN": "Geometry # (within polytope)",
    "NTRIANGS": "# of Triangulations (within geometry)",
    "IPOLYXJ": "CY Intersection Polynomial (Basis)",
    "ITENSXJ": "CY Intersection Tensor (Basis)",
    "CHERN2XJ": "CY 2nd Chern Class (Basis)",
    "CHERN2XNUMS": "CY 2nd Chern Numbers",
    "MORIMAT": "CY Mori Cone Matrix",
    "KAHLERMAT": "CY Kahler Cone Matrix",
    "SWISSCHEESE": "Swiss Cheese Solutions"
}


TORIC_SWISSCHEESE = {
    "NLARGE": "# of Large Cycles",
    "RMAT2CYCLE": "2-Cycle Rotation Matrix",
    "RMAT4CYCLE": "4-Cycle Rotation Matrix",
    "INTBASIS2CYCLE": "2-Cycle Z-Basis?",
    "INTBASIS4CYCLE": "4-Cycle Z-Basis?",
    "HOM": "Homogeneity Condition Satisfied?"
}


EXPLICIT_SWISSCHEESE = {
    "RMAT2CYCLE": "Diagonal 2-Cycle Rotation Matrix",
    "DIAGCOEFFS": "Diagonal Volume Coefficients"
}


TRIANG = {
    "TRIANGN": "Triangulation # (within geometry)",
    "ALLTRIANGN": "Triangulation # (within polytope)",
    "TRIANG": "Triangulation",
    "SRIDEAL": "Stanley-Reisner Ideal",
    "CHERNAD": "Ambient Chern Classes (Toric)",
    "CHERNAJ": "Ambient Chern Classes (Basis)",
    "CHERN2XD": "CY 2nd Chern Class (Toric)",
    "CHERN3XD": "CY 3rd Chern Class (Toric)",
    "CHERN3XJ": "CY 3rd Chern Class (Basis)",
    "IPOLYAD": "Ambient Intersection Polynomial (Toric)",
    "ITENSAD": "Ambient Intersection Tensor (Toric)",
    "IPOLYAJ": "Ambient Intersection Polynomial (Basis)",
    "ITENSAJ": "Ambient Intersection Tensor (Basis)",
    "IPOLYXD": "CY Intersection Polynomial (Toric)",
    "ITENSXD": "CY Intersection Tensor (Toric)",
    "MORIMATP": "Phase Mori Cone Matrix",
    "KAHLERMATP": "Phase Kahler Cone Matrix"
}


INVOL = {
    "INVOLN": "Involution # (within triangulation)",
    "INVOL": "Non-trivial Identical Divisor (NID) Involution",
    "INVOLDIVCOHOM": "Cohomology of Exchanged Divisors",
    "CYPOLY": "Calabi-Yau Hypersurface Polynomial",
    "NCYTERMS": "# Terms of Calabi-Yau Hypersurface Polynomial",
    "SYMCYPOLY": "Symmetrized Calabi-Yau Hypersurface Polynomial",
    "NSYMCYTERMS": "# Terms of Symmetrized Calabi-Yau Hypersurface Polynomial",
    "SRINVOL": "Involution Preserves Stanley-Reisner Ideal?",
    "ITENSXDINVOL": "Involution Preserves CY Intersection Tensor?",
    "SMOOTH": "Quotient Space is Smooth?",
    "VOLFORMPARITY": "Parity of the Holomorphic Volume Form",
    "OPLANES": "Orientifold Planes",
    "H11+": "Even-Parity H11",
    "H11-": "Odd-Parity H11",
    "H21+": "Even-Parity H21",
    "H21-": "Odd-Parity H21"
}
