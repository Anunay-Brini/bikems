const puppeteer = require('puppeteer');

(async () => {
  const browser = await puppeteer.launch();
  const page = await browser.newPage();
  await page.setViewport({ width: 1280, height: 800 });
  
  try {
      console.log('Taking landing page screenshot...');
      await page.goto('http://127.0.0.1:8001/', {waitUntil: 'networkidle2'});
      await page.screenshot({path: 'e:/bikems/FSD_Report_bikems/landing_page.png'});
      
      console.log('Taking login page screenshot...');
      await page.goto('http://127.0.0.1:8001/login', {waitUntil: 'networkidle2'});
      await page.screenshot({path: 'e:/bikems/FSD_Report_bikems/login_page.png'});

      console.log('Taking bikes page screenshot...');
      await page.goto('http://127.0.0.1:8001/bikes', {waitUntil: 'networkidle2'});
      await page.screenshot({path: 'e:/bikems/FSD_Report_bikems/bikes_page.png'});
      
  } catch (e) {
      console.error(e);
  } finally {
      await browser.close();
  }
})();
