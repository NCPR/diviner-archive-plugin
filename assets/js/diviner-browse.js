
import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { AppContainer } from 'react-hot-loader';

import App from './browser-app/app';
import configureStore from './browser-app/config/configureStore';

const archiverContainer = document.getElementById('diviner-browse-container');
const store = configureStore();

if (archiverContainer) {
	ReactDOM.render(
		<App></App>,
		archiverContainer
	);
}

