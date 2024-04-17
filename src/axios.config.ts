/**
 * Localized script variables.
 * 
 * External variables.
 */
declare var mmorphMeta: any

/**
 * Config axios.
 */
import axios from 'axios';

if (mmorphMeta) {
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
    axios.defaults.headers.common['X-WP-Nonce'] = mmorphMeta.restNonce
}