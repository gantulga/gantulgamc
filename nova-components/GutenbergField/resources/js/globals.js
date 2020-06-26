
window.wp = {
    apiFetch,
    //url: { addQueryArgs },
};

window.userSettings = {
    uid: window.config.userId,
};

// set your root path
window.wpApiSettings = {
    root: window.config.base + '/',
    ...window.wpApiSettings
};

const types = {
    'page': {
        labels: {
            Document: 'Page',
            document: 'Page',
            posts: 'Pages',
            extras: 'Fields' // extra tab label in sidebar
        },
        name: 'Page', rest_base: 'pages', slug: 'page',
        supports: {
            author: false,
            comments: false, // hide discussion-panel
            'custom-fields': true,
            document: true, // * hide document tab
            editor: false,
            'media-library': false, // * hide media library
            'page-attributes': false, // hide page-attributes panel
            posts: false, // * hide posts-panel
            revisions: false,
            'template-settings': false, // * hide template-settings panel
            thumbnail: true, // featured-image panel
            title: false, // show title on editor
            extras: false,
        },
        viewable: false,
        saveable: false,
        publishable: false,
        autosaveable: false
    },
    'block': {
        name: 'Blocks', rest_base: 'blocks', slug: 'wp_block',
        description: '',
        supports: {
            title: true,
            editor: true,
        },
        viewable: false,
    }
};

const requestPaths = {
    'load-types': {
        method: 'GET',
        regex: /\/wp\/v2\/types/g,
        process: () => {
            return new Promise(resolve => {
                return resolve(types);
            });
        }
    },
    'load-type-page': {
        method: 'GET',
        regex: /\/wp\/v2\/types\/page/g,
        process: () => {
            return new Promise(resolve => {
                return resolve(types.page);
            });
        }
    },
    'load-node': {
        method: 'GET',
        regex: /\/wp\/v2\/pages\/(\d*)/g,
        process: () => {
            return new Promise(resolve => {
                resolve({
                    "categories": [],
                    "content": { "raw": "", "rendered": "" },
                    "featured_media": 0,
                    "id": 1,
                    "parent": 0,
                    "permalink_template": "",
                    //"revisions": { "count": 0, "last_id": 0 },
                    "status": "draft",
                    "theme_style": true,
                    "type": "page"
                });
            });
        }
    },
}

function processPath(options) {
    for (const key in requestPaths) {
        if (requestPaths.hasOwnProperty(key)) {
            const requestPath = requestPaths[key];
            requestPath.regex.lastIndex = 0;
            let matches = requestPath.regex.exec(options.path + '');

            if (matches && matches.length > 0 && ((options.method && options.method === requestPath.method) || 'GET' === requestPath.method)) {
                return requestPath.process(matches, options.data, options.body);
            }
        }
    }

    // None found, return type settings.
    return new Promise((resolve, reject) => {
        return reject({
            code: 'api_handler_not_found',
            message: 'API handler not found.',
            data: {
                path: options.path,
                status: 404
            }
        });
    });
}

function apiFetch(options) {
    // Do something with those options like calling an API
    // or actions from your store...
    console.log('options', options)
    return processPath(options);
}
