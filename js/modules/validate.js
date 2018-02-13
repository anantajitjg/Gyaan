/**
* Validation module
* -----------------
*/

class ValidateForms {
	constructor() {
		this.$commentForm = $(".comment-form.needs-validation");
		this.defaultStyleClass = "default-style";
		this.events();
	}

	events() {
		this.$commentForm.on("submit", this.commentFormValidation.bind(this));
	}

	commentFormValidation(e) {
		const $form = this.$commentForm;
		const default_class = this.defaultStyleClass;
		if($form[0].checkValidity() === false) {
			e.preventDefault();
		}
		$form.addClass("was-validated");
		let inputFields = $form.find("input.form-control");
		$.each(inputFields, function(i, elem) {
			let $elem = $(elem);
			if($elem.val().length === 0) {
				$elem.addClass(default_class);
				$elem.keyup(function() {
					if($(this).val().length > 0 ) {
						$(this).removeClass(default_class);
					} else {
						$(this).addClass(default_class);
					}
				});
			} else {
				$elem.removeClass(default_class);
			}
		});
	}
}

export default ValidateForms;