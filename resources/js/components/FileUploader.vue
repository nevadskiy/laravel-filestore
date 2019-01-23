<template>
    <div class="field">
        <div class="file" v-show="!uploading">
            <label class="file-label">
                <input
                        class="file-input"
                        type="file"
                        :name="name"
                        ref="input"
                        @change="onFileChange"
                >
                <span class="file-cta">
                  <span class="file-label">
                    {{ this.label }}
                  </span>
                </span>
            </label>
        </div>

        <progress v-show="uploading" class="progress is-primary" :value="uploadProgress" max="100"></progress>
    </div>
</template>

<script>
  export default {
    props: {
      id: {
        type: String,
        required: true,
      },

      url: {
        type: String,
        required: true,
      },

      method: {
        type: String,
        default: 'POST',
      },

      name: {
        type: String,
        default: 'file',
      },

      label: {
        type: String,
        default: 'Upload file...',
      }
    },

    data() {
      return {
        uploading: false,
        uploadProgress: 0,
        error: false,
      };
    },

    methods: {
      onFileChange() {
        console.log('changed');

        this.initUploading();

        axios.post(this.url, this.buildForm(), {
          onUploadProgress: event => this.updateUploadProgress(event),
        })
          .then((response) => {
            // TODO: this.onUploadFinish(response.data);
          })
          .catch((error) => {
            this.assignErrors(error);
          })
          .finally(() => {
            this.resetUploading();
          });
      },

      buildForm() {
        const file = this.$refs.input.files[0];
        const form = new FormData();
        form.append(this.name, file);

        return form;
      },

      initUploading() {
        this.uploading = true;
        this.error = false;
        this.attachBrowserExitWarning();
      },

      assignErrors(error) {
        if (error.response.status === 422) {
          [this.error] = error.response.data.errors.logo;
        } else if (error.response.status === 413) {
          this.error = 'Image size must be less than 20mb';
        }
      },

      updateUploadProgress(event) {
        this.uploadProgress = Math.round((event.loaded * 100) / event.total);
      },

      resetUploading() {
        this.uploading = false;
        this.uploadProgress = 0;
        this.$refs.input.value = null;
      },

      attachBrowserExitWarning() {
        window.onbeforeunload = (e) => {
          if (this.uploading) {
            const warningMessage = 'You started uploading process. Are you sure you want to navigate away?';
            e.returnValue = warningMessage;
            return warningMessage;
          }

          return null;
        };
      },
    },
  };
</script>
