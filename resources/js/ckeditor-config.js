import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

// Initialize CKEditor with basic configuration
window.initCKEditor = (selector, options = {}) => {
    const defaultConfig = {
        toolbar: {
            items: [
                'heading', '|',
                'bold', 'italic', '|',
                'link', 'bulletedList', 'numberedList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo'
            ]
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' }
            ]
        },
        link: {
            decorators: {
                openInNewTab: {
                    mode: 'manual',
                    label: 'Open in a new tab',
                    defaultValue: true,
                    attributes: {
                        target: '_blank',
                        rel: 'noopener noreferrer'
                    }
                }
            }
        },
        placeholder: 'Enter digital information about this artwork...',
        ...options
    };

    return ClassicEditor
        .create(document.querySelector(selector), defaultConfig)
        .catch(error => {
            console.error('CKEditor initialization error:', error);
        });
};

// Auto-initialize all elements with .ckeditor class
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.ckeditor').forEach(element => {
        if (!element.dataset.ckeditorInitialized) {
            initCKEditor('#' + element.id);
            element.dataset.ckeditorInitialized = 'true';
        }
    });
});