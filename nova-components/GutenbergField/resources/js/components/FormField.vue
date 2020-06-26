<template>
    <div>
        <!--default-field :field="field" :errors="errors">
            <template slot="field">
                <input :id="field.name" type="text"
                    class="w-full form-control form-input form-input-bordered"
                    :class="errorClasses"
                    :placeholder="field.name"
                    v-model="value"
                />
            </template>
        </default-field-->
        <div id="editor">
            <EditorProvider
				settings="editorSettings"
				post="post"
			>
			</EditorProvider>
        </div>
    </div>
</template>

<script>
import Vue from 'vue'
import { VuePlugin } from 'vuera'
Vue.use(VuePlugin)

import { FormField, HandlesValidationErrors } from 'laravel-nova'

// Importing global variables that Gutenberg requires
import '../globals';

// Importing domReady and editPost modules
import { data, domReady, editPost } from '@frontkom/gutenberg-js';

// Don't forget to import the style
import '@frontkom/gutenberg-js/build/css/block-library/style.css';
import '@frontkom/gutenberg-js/build/css/style.css';

// DOM element id where editor will be displayed
const target = 'editor';

// Post properties
const postType = 'page'; // or 'post'
const postId = 1;

// Some editor settings
const settings = {
    alignWide: true,
    availableTemplates: [],
    allowedBlockTypes: true,
    disableCustomColors: false,
    disableCustomFontSizes: false,
    disablePostFormats: false,
    titlePlaceholder: "Add title",
    bodyPlaceholder: "Write your story",
    isRTL: false,
    autosaveInterval: 10,
    //styles: [],
    postLock: {
        isLocked: false,
    },
    hasFixedToolbar: false,
    fixedToolbar: false,

    // @frontkom/gutenberg-js settings
    canAutosave: false,  // to disable the Editor Autosave feature (default: true)
    canPublish: false,   // to disable the Editor Publish feature (default: true)
    canSave: false,      // to disable the Editor Save feature (default: true)
    mediaLibrary: true, // to disable the Media Library feature (default: true)
};

// Post properties to override
const overridePost = {};

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    mounted() {
        //console.log(gutenberg);
        editPost.initializeEditor(target, postType, postId, settings, overridePost);
    },

    methods: {
        /*
         * Set the initial, internal value for the field.
         */
        setInitialValue() {
            this.value = this.field.value || ''
        },

        /**
         * Fill the given FormData object with the field's internal value.
         */
        fill(formData) {
            //formData.append(this.field.attribute, this.value || '')
            console.log('gutenberg value', this.field.attribute, data.select( 'core/editor' ).getEditedPostContent())
            formData.append(this.field.attribute, data.select( 'core/editor' ).getEditedPostContent())
        },

        /**
         * Update the field's internal value.
         */
        handleChange(value) {
            this.value = value
        },
    },
}
</script>

<style>

.edit-post-header {
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
}

.edit-post-sidebar {
    position: absolute;
    top: 56px;
}

body.is-fullscreen-mode .edit-post-header,
body.is-fullscreen-mode .edit-post-sidebar {
    position: fixed;
}

</style>
