/**
 * Localized script variables.
 * 
 * External variables.
 */
declare var mpMetDat: any

/**
 * Config axios.
 */
import axios from 'axios';

const http = axios.create({});

http.defaults.headers.common['X-Requested-With']  = 'XMLHttpRequest'
http.defaults.headers.common['X-WP-Nonce']        = mpMetDat.rNonce

export default http