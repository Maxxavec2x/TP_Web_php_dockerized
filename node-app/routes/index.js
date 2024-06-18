const express = require('express');
const router = express.Router();
const { fetchData } = require('../api');

// Define the root route
router.get('/', async (req, res) => {
  const url = 'http://web/API.php';
  try {
    const data = await fetchData(url);
    res.send(`Hello World`);
    // res.send(`Fetched Data: ${JSON.stringify(data, null, 2)}`);
  } catch (error) {
    res.status(500).send('Error fetching data');
  }
});

// Define another route
router.get('/test', (req, res) => {
  res.send('This is a test route from the routes file');
});

module.exports = router;