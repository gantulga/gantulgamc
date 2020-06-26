<template>
  <div>
    <vue-ckeditor :value="value" @input="handleTextChange" :config="ckeditor4Config"/>
    <resource-browser
        :field="field"
        resource-name="media"
        :via-resource-id="resourceId"
        :load-cards="false"
        @select="imageSelected"
        :open="browseModalOpen"
        v-if="browseModalOpen"
        @onClose="closeModal"
    />
  </div>
</template>
<script>
import VueCkeditor from "vue-ckeditor2";

export default {
  components: { VueCkeditor },
  props: ["value", "field", "resourceId", "config"],
  data(){
      return {
          browseModalOpen: false,
      }
  },
  computed: {
    ckeditor4Config() {
      return {
          'toolbar': [
                //['Cut','Copy','Paste','PasteText','PasteFromWord'],
                ['Format'],['Bold','Italic','Strike','RemoveFormat'],
                ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
                ['Link','Unlink'],
                ['Image','Embed','IframeEmbed','Table','HorizontalRule','SpecialChar'],
                ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ],
                //['Maximize'],
                //['Source'],
                //'/',
                ['ShowBlocks', 'About'],
                ['Maximize'],
                ['Source'],
        ],
        'extraPlugins': 'embed,autoembed,image2',
        'image2_alignClasses': [ 'align-left', 'align-center', 'align-right' ],
        'embed_provider': '//ckeditor.iframe.ly/api/oembed?url={url}&callback={callback}',
        'height': 350,
        ...this.field.ckeditorConfig,
        ...this.config,
      };
    }
  },
  methods: {
    handleTextChange(text) {
      this.$emit("input", text);
    },
    browseModal(){
        this.browseModalOpen = true;
    },
    closeModal() {
        this.browseModalOpen = false;
    },
    imageSelected(selectedResources){
        try{
            let url = this.field.diskPath + selectedResources[0].file;
            CKEDITOR.dialog.getCurrent().setValueOf('info','src',encodeURI(url));
        }
        catch(e){
            console.error(e);
        }
        this.closeModal();
    }
  },
  mounted() {

    let browseModal = this.browseModal;
    CKEDITOR.once("dialogDefinition", function(evt){
      var dialog = evt.data;
      console.log(dialog);
      if (dialog.name == "image2") {
        // Get dialog we want
        var def = evt.data.definition;
        // Change dialog z-index
        let onShow = def.onShow;
        def.onShow = function(){
            //this.getElement()
            onShow.bind(this)();
            document.getElementsByClassName("cke_dialog")[0].style.zIndex = 19;
            document.getElementsByClassName("cke_dialog_background_cover")[0].style.zIndex = 18;
        }
        //Get The Desired Tab Element
        var infoTab = def.getContents("info");
        infoTab.elements[0].id = 'src-vbox';
        console.log(infoTab);
        //Add Our Button
        infoTab.add({
          type: "button",
          //hidden: true,
          id: "browse-nova",
          label: "Browse Server", //CKEDITOR.lang.common.browseServer,
          onClick: function(){
              browseModal();
          }
        }, 'src-vbox');
      }
    });
  }
};
</script>
