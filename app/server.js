const express = require('express');
const serveStatic = require("serve-static");
const path = require('path');
app = express();
app.use(serveStatic(path.join(__dirname, 'dist')));
const port = 3000;
app.listen(port);
