import { config } from './config_write';

let CONFIG;
config.subscribe(value => CONFIG = value);

export { CONFIG };
