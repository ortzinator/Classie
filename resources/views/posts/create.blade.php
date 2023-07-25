@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="/posts" method="POST" id="postForm" x-data="imageForm"
              enctype="multipart/form-data">
            {{ csrf_field() }}

            <template x-for="image in images">
                <template x-if="image.status === 'success'">
                    <input type="hidden" name="images[]" :value="encodeObjectForHtml(image)">
                </template>
            </template>

            <legend>Create Post</legend>

            <div class="mb-3">
                <label class="form-label" for="title">Title:</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                       value="{{ old('title') }}" required>
                @error('title')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="body">Description:</label>
                <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" rows="3"
                          required>{{ old('body') }}</textarea>
                @error('body')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror
            </div>

            <div class="mb-2 bg-body p-3 border">
                <h5>Upload Images</h5>
                <input x-ref="fileInput" type="file" accept="image/*"
                       @change.prevent="uploadImages($event)"
                       style="display: none" aria-hidden="true" multiple>

                <button class="btn btn-secondary mb-2" @click.prevent="$refs.fileInput.click()">Choose files</button>
                <div class="row row-cols-md-6 row-cols-2 g-2 mb-2">
                    <template x-for="(image, index) in images">
                        <div class="col">
                            <div class="card group">
                                <div class="ratio ratio-4x3">
                                    <img :src="image.status === 'success' ? imageUrl(image.src) : image.src"
                                         class="card-img object-fit-cover"
                                    >
                                </div>
                                <div class="position-absolute top-0 end-0 p-3 d-flex justify-content-end align-items-start opacity-75">
                                    <button class="btn btn-danger invisible group-hover:visible opacity-100-hover"
                                            @click.prevent="removeImage(index)">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             width="25" height="25"
                                             stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/>
                                        </svg>

                                    </button>
                                </div>
                                <div class="card-body" :class="statusClasses(image)">
                                    <template x-if="image.status == 'upload'">
                                        <div>
                                            Uploading...
                                            <span class="spinner-border spinner-border-sm" role="status"></span>
                                        </div>
                                    </template>
                                    <template x-if="image.status == 'fail'">
                                        <div>
                                            Upload failed
                                        </div>
                                    </template>
                                    <template x-if="image.status == 'success'">
                                        <div>
                                            Success
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" :disabled="submitDisabled">Submit</button>
        </form>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('imageForm', () =>
                ({
                    images: [],
                    assetDir: '{{ asset('storage') }}',
                    submitDisabled: false,

                    init() {
                        let oldImages = @js(old('images', []));
                        if (oldImages.length > 0) {
                            oldImages.forEach((image) => {
                                this.images.push(JSON.parse(image));
                            });
                        }
                    },

                    disableSubmit() {
                        this.submitDisabled = true;
                    },

                    enableSubmit() {
                        this.submitDisabled = false;
                    },

                    imageUrl(path) {
                        return `${this.assetDir}/tmp/th_${path}`;
                    },

                    statusClasses(image) {
                        return {
                            'text-danger': image.status == 'fail',
                            'text-success': image.status == 'success',
                        };
                    },

                    fileToDataUrl(file) {
                        return URL.createObjectURL(file);
                    },

                    removeImage(index) {
                        URL.revokeObjectURL(this.images[index].src);
                        this.images.splice(index, 1);
                    },

                    uploadImage(image, index) {
                        const formData = new FormData();
                        formData.append('image', image.file);

                        return axios.post('/upload', formData)
                            .then((response) => {
                                this.images[index].status = 'success';
                                URL.revokeObjectURL(this.images[index].src);
                                this.images[index].src = response.data;
                            }).catch((error) => {
                                this.images[index].status = 'fail';
                            });
                    },

                    encodeObjectForHtml(object) {
                        // return btoa(JSON.stringify(object));
                        return JSON.stringify(object);
                    },

                    uploadImages(e) {
                        this.disableSubmit();
                        let fileList = e.target.files;
                        [...fileList].forEach((file) => {
                            this.images.push({ file: file, status: 'upload', src: this.fileToDataUrl(file) });
                        });

                        let promises = [];

                        this.images.forEach((image, index) => {
                            promises.push(this.uploadImage(image, index));
                        });

                        Promise.allSettled(promises).then(() => {
                            this.enableSubmit();
                        });
                    },
                }));
        });
    </script>
@endsection