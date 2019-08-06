import React, { Component } from 'react';
import { connect } from 'react-redux';

import SearchFacets from '../components/searchfacets';
import Controls from '../components/controls';
import Grid from '../components/grid';
import Popup from '../components/popup';

import { startApp } from '../actions';

/**
 * The main container
 */

class Main extends Component {

	componentDidMount() {
		this.props.startApp(this.props.location);
	}

	render() {
		return (
			<div className='a-main'>
				<div className="a-row a-row--controls">
					<div className="a-col a-col--controls">
						<Controls />
					</div>
				</div>
				<div className="a-row a-row--facets-grid">
					<div className="a-col a-col--facets">
						<SearchFacets />
					</div>
					<div className="a-col a-col--grid">
						<Grid />
					</div>
				</div>
				<Popup></Popup>
			</div>
		);
	}
}

export default connect(null, { startApp })(Main);
