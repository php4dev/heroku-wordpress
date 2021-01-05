const el = wp.element.createElement;
const {Fragment} = wp.element;

const {
    registerBlockType
} = wp.blocks;

const {
    PanelBody,
    TextareaControl,
    TextControl,
    SelectControl,
    CheckboxControl,
    ToggleControl,
    Dashicon,
    Toolbar,
    Button,
    Tooltip,
} = wp.components;

const ServerSideRender = wp.serverSideRender;

const {
    PlainText,
    InspectorControls,
    BlockControls,
} = wp.blockEditor;

const iconBuddyForms = el('svg', {width: 24, height: 24},
    el('path', {d: "M9.247 0.323c6.45-1.52 12.91 2.476 14.43 8.925s-2.476 12.91-8.925 14.43c-6.45 1.52-12.91-2.476-14.43-8.925s2.476-12.91 8.925-14.43zM9.033 14.121c-0.445-0.604-0.939-1.014-1.656-1.269-0.636 0.196-1.18 0.176-1.8-0.066-1.857 0.507-2.828 2.484-2.886 4.229 1.413 0.025 2.825 0.050 4.237 0.076M5.007 11.447c0.662 0.864 1.901 1.029 2.766 0.366s1.030-1.9 0.367-2.766c-0.662-0.864-1.901-1.029-2.766-0.366s-1.029 1.9-0.367 2.766zM7.476 18.878l7.256-0.376c-0.096-1.701-1.066-3.6-2.87-4.103-0.621 0.241-1.165 0.259-1.8 0.059-1.816 0.635-2.65 2.675-2.585 4.419zM9.399 13.162c0.72 0.817 1.968 0.894 2.784 0.173s0.894-1.968 0.173-2.784c-0.72-0.817-1.968-0.894-2.784-0.173s-0.894 1.968-0.173 2.784zM14.007 9.588h6.794v-1.109h-6.794v1.109zM14.007 11.645h6.794v-1.109h-6.794v1.109zM14.007 7.532h6.794v-1.109h-6.794v1.109zM9.033 14.121c-0.192 0.118-0.374 0.251-0.544 0.399-0.205 0.177-0.393 0.375-0.564 0.585-0.175 0.216-0.331 0.447-0.468 0.688-0.136 0.243-0.255 0.495-0.353 0.757-0.068 0.177-0.126 0.358-0.176 0.541"})
);

const {__} = wp.i18n;

//
// Embed a form
//
registerBlockType('buddyforms/bf-insert-form', {
    title: __('BuddyForm Form', 'buddyforms'),
    icon: iconBuddyForms,
    category: 'buddyforms',
    attributes: {
        post_type: {
            type: 'string',
        },
        customfields: {
            type: 'object',
        },
        post_id: {
            type: 'string',
        },
        bf_form_slug: {
            type: 'string',
        },
    },
    edit: function (props) {

        var forms = [
            {value: 'no', label: __('Select a Form', 'buddyforms')},
        ];
        for (var key in buddyforms_forms) {
            forms.push({value: key, label: buddyforms_forms[key]});
        }

        return [

            el(ServerSideRender, {
                block: 'buddyforms/bf-insert-form',
                attributes: props.attributes,
            }),

            el(InspectorControls, {},
                el('p', {}, ''),
                el(SelectControl, {
                    label: __('Please Select a form', 'buddyforms'),
                    value: props.attributes.bf_form_slug,
                    options: forms,
                    onChange: (value) => {
                        props.setAttributes({bf_form_slug: value});
                    },
                }),
                el('p', {}, ''),
                el('a', {
                    href: buddyforms_create_new_form_url,
                    target: 'new'
                }, __('Create a new Form', 'buddyforms')),
            )
        ];
    },

    save: function () {
        return null;
    },
});


//
// Embed a reset password form
//
registerBlockType('buddyforms/bf-password-reset-form', {
    title: __('Password Reset Form', 'buddyforms'),
    icon: 'admin-network',
    category: 'buddyforms',

    edit: function (props) {

        var forms = [
            {value: 'no', label: __('Select a Form', 'buddyforms')},
        ];
        for (var key in buddyforms_forms) {
            forms.push({value: key, label: buddyforms_forms[key]});
        }

        return [

            el(ServerSideRender, {
                block: 'buddyforms/bf-password-reset-form',
                attributes: props.attributes,
            }),

            el(InspectorControls, {},
                el('p', {}, ''),
                el(TextControl, {
                    label: __('Redirect URL', 'buddyforms'),
                    value: props.attributes.bf_redirect_url,
                    onChange: (value) => {
                        props.setAttributes({bf_redirect_url: value});
                    },
                }),
            )
        ];
    },

    save: function () {
        return null;
    },
});


//
// Embed a login form
//
registerBlockType('buddyforms/bf-embed-login-form', {
    title: __('Login/logout Form', 'buddyforms'),
    icon: 'lock',
    category: 'buddyforms',

    edit: function (props) {

        var forms = [
            {value: 'no', label: __('Select a Registration Form', 'buddyforms')},
        ];
        for (var key in buddyforms_registration_forms) {
            forms.push({value: key, label: buddyforms_registration_forms[key]});
        }

        return [

            el(ServerSideRender, {
                block: 'buddyforms/bf-embed-login-form',
                attributes: props.attributes,
            }),

            el(InspectorControls, {},
                el('p', {}, ''),
                el(SelectControl, {
                    label: __('Select a Registration Form', 'buddyforms'),
                    value: props.attributes.bf_form_slug,
                    options: forms,
                    onChange: (value) => {
                        props.setAttributes({bf_form_slug: value});
                    },
                }),
                el(TextControl, {
                    label: __('Redirect URL', 'buddyforms'),
                    value: props.attributes.bf_redirect_url,
                    onChange: (value) => {
                        props.setAttributes({bf_redirect_url: value});
                    },
                }),
                el(TextControl, {
                    label: __('Title', 'buddyforms'),
                    value: props.attributes.bf_title,
                    onChange: (value) => {
                        props.setAttributes({bf_title: value});
                    },
                }),
            )
        ];
    },

    save: function () {
        return null;
    },
});


//
// Embed a Navigation
//
registerBlockType('buddyforms/bf-navigation', {
    title: __('BuddyForms Navigation', 'buddyforms'),
    icon: 'menu',
    category: 'buddyforms',

    edit: function (props) {

        var bf_nav_style = [
            {value: 'buddyforms_nav', label: __('View - Add New', 'buddyforms')},
            {value: 'buddyforms_button_view_posts', label: __('View Posts', 'buddyforms')},
            {value: 'buddyforms_button_add_new', label: __('Add New', 'buddyforms')},
        ];


        var forms = [
            {value: 'no', label: __('Select a Form', 'buddyforms')},
        ];
        for (var key in buddyforms_post_forms) {
            forms.push({value: key, label: buddyforms_post_forms[key]});
        }

        return [

            el(ServerSideRender, {
                block: 'buddyforms/bf-navigation',
                attributes: props.attributes,
            }),

            el(InspectorControls, {},
                el('p', {}, ''),
                el(SelectControl, {
                    label: __('Please Select a form', 'buddyforms'),
                    'description': '',
                    value: props.attributes.bf_form_slug,
                    options: forms,
                    onChange: (value) => {
                        props.setAttributes({bf_form_slug: value});
                    },
                }),
                el(SelectControl, {
                    label: __('Navigation Style', 'buddyforms'),
                    value: props.attributes.bf_nav_style,
                    options: bf_nav_style,
                    onChange: (value) => {
                        props.setAttributes({bf_nav_style: value});
                    },
                }),
                el(TextControl, {
                    label: __('Label Add', 'buddyforms'),
                    value: props.attributes.bf_label_add,
                    onChange: (value) => {
                        props.setAttributes({bf_label_add: value});
                    },
                }),
                el(TextControl, {
                    label: __('Label View', 'buddyforms'),
                    value: props.attributes.bf_label_view,
                    onChange: (value) => {
                        props.setAttributes({bf_label_view: value});
                    },
                }),
                el(TextControl, {
                    label: __('Separator', 'buddyforms'),
                    value: props.attributes.bf_nav_separator,
                    onChange: (value) => {
                        props.setAttributes({bf_nav_separator: value});
                    },
                }),
            )
        ];
    },

    save: function () {
        return null;
    },
});


//
// Display Submissions
//
registerBlockType('buddyforms/bf-list-submissions', {
    title: __('List Submissions', 'buddyforms'),
    icon: 'list-view',
    category: 'buddyforms',

    edit: function (props) {

        //
        // Generate the Select options arrays
        //
        var bf_by_author = [
            {value: 'logged_in_user', label: __('Logged in Author Posts', 'buddyforms')},
            {value: 'all_users', label: __('All Author Posts', 'buddyforms')},
            {value: 'author_ids', label: __('Author ID\'S', 'buddyforms')},
        ];

        var bf_by_form = [
            {value: 'form', label: __('Form Submissions', 'buddyforms')},
            {value: 'all', label: __('Form selected Post Type', 'buddyforms')},
        ];

        var bf_list_posts_style_options = [
            {value: 'list', label: __('List', 'buddyforms')},
            {value: 'table', label: __('Table', 'buddyforms')},
        ];

        var forms = [
            {value: 'no', label: __('Select a Form', 'buddyforms')},
        ];
        for (var key in buddyforms_forms) {
            forms.push({value: key, label: buddyforms_forms[key]});
        }

        var permission = [
            {value: 'public', label: __('Public (Unregistered Users)', 'buddyforms')},
            {value: 'private', label: __('Private (Logged in user only) ', 'buddyforms')},
        ];
        for (var key in buddyforms_roles) {
            permission.push({value: key, label: buddyforms_roles[key]});
        }

        return [

            el(ServerSideRender, {
                block: 'buddyforms/bf-list-submissions',
                attributes: props.attributes,
            }),

            el(InspectorControls, {},
                el('p', {}, ''),
                el(SelectControl, {
                    label: __('Please Select a form', 'buddyforms'),
                    value: props.attributes.bf_form_slug,
                    options: forms,
                    onChange: (value) => {
                        props.setAttributes({bf_form_slug: value});
                    },
                }),
                el('p', {}, ''),
                el('b', {}, __('Restrict Access to this Block', 'buddyforms')),
                el(SelectControl, {
                    label: __('Permissions', 'buddyforms'),
                    value: props.attributes.bf_rights,
                    options: permission,
                    onChange: (value) => {
                        props.setAttributes({bf_rights: value});
                    },
                }),
                el('p', {}, ''),
                el('b', {}, __('Filter Posts', 'buddyforms')),
                el(SelectControl, {
                    label: __('by Author', 'buddyforms'),
                    value: props.attributes.bf_by_author,
                    options: bf_by_author,
                    onChange: (value) => {
                        props.setAttributes({bf_by_author: value});
                    },
                }),
                el(TextControl, {
                    label: __('Author ID\'s', 'buddyforms'),
                    value: props.attributes.bf_author_ids,
                    onChange: (value) => {
                        props.setAttributes({bf_author_ids: value});
                    },
                }),
                el(SelectControl, {
                    label: __('by Form', 'buddyforms'),
                    value: props.attributes.bf_by_form,
                    options: bf_by_form,
                    onChange: (value) => {
                        props.setAttributes({bf_by_form: value});
                    },
                }),
                el(TextControl, {
                    label: __('Posts peer page', 'buddyforms'),
                    value: props.attributes.bf_posts_per_page,
                    onChange: (value) => {
                        props.setAttributes({bf_posts_per_page: value});
                    },
                }),
                el('p', {}, ''),
                el('b', {}, __('Template', 'buddyforms')),
                el(SelectControl, {
                    label: __('List or Table', 'buddyforms'),
                    value: props.attributes.bf_list_posts_style,
                    options: bf_list_posts_style_options,
                    onChange: (value) => {
                        props.setAttributes({bf_list_posts_style: value});
                    },
                }),
            )
        ];
    },

    save: function () {
        return null;
    },
});
