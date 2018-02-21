/**
* Validation module
* -----------------
*/

class ValidateForms {
	constructor() {
		this.$commentForm = $(".comment-form.needs-validation");
		this.$searchForm = $(".gyaan-search-form");
		this.defaultStyleClass = "default-style";
		this.events();
	}

	events() {
		this.$commentForm.on("submit", this.formValidation.bind(this));
		this.$searchForm.on("submit", this.formValidation.bind(this));
	}

	formValidation(e) {
		const $form = $(e.target);
		if($form[0].checkValidity() === false) {
			e.preventDefault();
		}
		$form.addClass("was-validated");
		this.applyDefaultStyle.call(this, $form);
	}

	applyDefaultStyle($form) {
		const default_class = this.defaultStyleClass;
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