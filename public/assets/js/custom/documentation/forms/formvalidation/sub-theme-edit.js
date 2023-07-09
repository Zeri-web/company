FormValidation.formValidation( {
    fields: {
        option: {
            validators: {
                notEmpty: {
                    message: 'Select theme is required'
                }
            }
        },

        description: {
            validators: {
                notEmpty: {
                    message: 'Description is required'
                }
            }
        },

    },
    plugins: { trigger: new FormValidation.plugins.Trigger(), bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: "" }) },
})