const express = require('express');
const app = express();
const port = process.env.PORT || 3000;

// Import routes
const indexRouter = require('./routes/index');

// Use routes
app.use('/', indexRouter);

app.listen(port, '0.0.0.0', () => {
  console.log(`Server running at http://0.0.0.0:${port}/`);
});