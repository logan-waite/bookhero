/*
    Defines the API route we are using.
*/
var api_url = '';

switch( process.env.NODE_ENV ){
  case 'development':
    api_url = 'http://dev.bookhero.com/api/v1';
  break;
  // case 'stage':
  //   api_url = "https://stage.heycatalog.com/api/v1";
  // break;
  case 'production':
    api_url = 'http://app.bookhero.net/api/v1';
  break;
}

// export const APP_CONFIG = {
//   API_URL: api_url,
// }

export const API_URL = api_url;
export const IS_DEV = process.env.NODE_ENV === 'development';