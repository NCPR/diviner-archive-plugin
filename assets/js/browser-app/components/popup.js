import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { SkyLightStateless } from 'react-skylight';
import { connect } from 'react-redux';
import { disableBodyScroll, enableBodyScroll } from 'body-scroll-lock';

import ArchiveItem from './archiveItem';
import * as postStore from '../utils/data/postsStore';
import { setPopupVisible, sequencePopupArchiveItem } from '../actions';
import { CONFIG } from '../globals/config';

const KEY_ARROW_RIGHT = 39;
const KEY_ARROW_LEFT = 37;

class Popup extends Component {

	constructor(props) {
		super(props);
		this.onKeyUp.bind(this);
		this.onPreviousClick.bind(this);
		this.onNextClick.bind(this);
		this.onCloseClicked.bind(this);
		this.lockBody.bind(this);
		this.unlockBody.bind(this);
		this._executeBeforeModalOpen.bind(this);
		this._executeAfterModalClose.bind(this);
	}

	componentWillMount() {
		document.addEventListener('keyup', this.onKeyUp);
	}

	componentWillUnmount() {
		document.removeEventListener('keyup', this.onKeyUp);
	}

	onKeyUp(e) {
		if (!e.keyCode) {
			return;
		}
		if (e.keyCode === KEY_ARROW_RIGHT) {
			this.props.onNextClick();
		}
		if (e.keyCode === KEY_ARROW_LEFT) {
			this.props.onPreviousClick();
		}
	}


	onPreviousClick() {
		this.props.onPreviousClick();
	}


	onNextClick() {
		this.props.onNextClick();
	}


	onCloseClicked() {
		this.props.onCloseClick();
	}

	lockBody() {
		document.body.classList.add('modal--open');
		const modal = document.querySelectorAll('.skylight-wrapper')[0];
		enableBodyScroll(modal);
	}

	unlockBody() {
		document.body.classList.remove('modal--open');
		const modal = document.querySelectorAll('.skylight-wrapper')[0];
		enableBodyScroll(modal);
	}

	_executeBeforeModalOpen() {
		this.lockBody();

	}


	_executeAfterModalClose() {
		this.unlockBody();
	}

	render() {
		const post = postStore.getPostsById(this.props.currentPopupPostId);
		const archiveItem = (post) ? (<ArchiveItem post={post} />) : undefined;

		if (this.props.popupPostVisible) {
			this.lockBody();
		} else {
			this.unlockBody();
		}

		let classes = 'a-sai__popup ';
		if (this.props.popupPostVisible) {
			classes += 'a-sai__popup--visible ';
		}

		return (
			<div
				className={classes}>
				<div className="a-sai__controls">
					<button
						className="a-sai__control-btn a-sai__control-btn--previous"
						onClick={this.onPreviousClick}
					>
						<span className="fas fa-arrow-left" aria-hidden="true"></span>
						<span className="a11y-visual-hide">
							{ CONFIG.browse_page_localization.popup_previous }
						</span>
					</button>
					<button
						className="a-sai__control-btn a-sai__control-btn--next"
						onClick={this.onNextClick}
					>
						<span className="a11y-visual-hide">
							{ CONFIG.browse_page_localization.popup_next}
						</span>
						<span className="fas fa-arrow-right" aria-hidden="true"></span>
					</button>
				</div>

				<SkyLightStateless
					isVisible={this.props.popupPostVisible}
					beforeOpen={this._executeBeforeModalOpen}
					afterClose={this._executeAfterModalClose}
					onOverlayClicked={this.onCloseClicked}
					onCloseClicked={this.onCloseClicked}
					ref="dialogWithCallBacks"
				>
					{archiveItem}
				</SkyLightStateless>
			</div>
		);
	}
}


Popup.propTypes = {
	currentPopupPostId: PropTypes.number,
	popupPostVisible: PropTypes.bool,
	onCloseClick: PropTypes.func,
	onPreviousClick: PropTypes.func,
	onNextClick: PropTypes.func
};

Popup.defaultProps = {
	onCloseClick: () => {},
	onPreviousClick: () => {},
	onNextClick: () => {},
};

const mapStateToProps = (state) => ({
	currentPopupPostId: state.currentPopupPostId,
	popupPostVisible: state.popupVisible,
});

/**
 * mapDispatchToProps
 *
 * Mapping property to dispatches
 */
const mapDispatchToProps = (dispatch) => ({
	onCloseClick: () => {
		dispatch(setPopupVisible(false))
	},
	onPreviousClick: () => dispatch(sequencePopupArchiveItem(-1)),
	onNextClick: () => dispatch(sequencePopupArchiveItem(1)),
});

export default connect(
	mapStateToProps,
	mapDispatchToProps
)(Popup);
