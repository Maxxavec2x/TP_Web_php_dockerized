const express = require('express');
const router = express.Router();
const { fetchData } = require('../api');

function makeStatistics(data) {
  const nbPosts = data.length
  
  return {
    nbPosts
  }
}

// Define the root route
router.get('/', async (req, res) => {
  const url = 'http://web/API.php';
  try {
    const data = await fetchData(url);
    // res.send(`Hello World`);
    res.send(`Fetched Data: ${JSON.stringify(data, null, 2)}`);
  } catch (error) {
    res.status(500).send('Error fetching data');
  }
});

// Define another route
router.get('/test', (req, res) => {
  res.send('This is a test route from the routes file');
});



router.get('/stats', async (req, res) => {
  const url = 'http://web/API.php';
  try {
    const data = await fetchData(url);
    stat = makeStatistics(data);

    const html = `
    <html>
      <head>
        <title>Statistics</title>
        <style>
          body {
            font-family: Arial, sans-serif;
            padding: 20px;
          }
          .stats-container {
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 20px;
          }
        </style>
      </head>
      <body>
        <h1>Statistics</h1>
        <div class="stats-container">
          <p>Number of Posts: ${stat.nbPosts}</p>
          <!-- Add more statistics display as needed -->
        </div>
      </body>
    </html>
  `;



    res.send(html);
  } catch (error) {
    res.status(500).send('Error fetching data');
  }
});
module.exports = router;