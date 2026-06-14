//
class MultiStepWizard {
  constructor(options) {
    this.currentStep = 0;

    this.steps = document.querySelectorAll(options.stepSelector);
    this.nextBtn = document.querySelector(options.nextBtn);
    this.prevBtn = document.querySelector(options.prevBtn);
    this.submitBtn = document.querySelector(options.submitBtn);
    this.indicators = document.querySelectorAll(options.indicatorSelector);

    this.onInit();
    this.bindEvents();
    this.updateUI();
  }

  onInit() {
    // Hide all except first
    this.steps.forEach((step, i) => {
      step.classList.toggle("hidden", i !== 0);
    });
  }

  bindEvents() {
    this.nextBtn?.addEventListener("click", () => this.next());
    this.prevBtn?.addEventListener("click", () => this.prev());
  }

  validateStep(index) {
    const step = this.steps[index];
    const inputs = step.querySelectorAll("input[required]");

    let valid = true;

    inputs.forEach((input) => {
      if (input.type === "radio") {
        const group = step.querySelectorAll(`input[name="${input.name}"]`);
        const checked = [...group].some((i) => i.checked);
        if (!checked) valid = false;
      }

      if (["text", "email", "tel", "checkbox"].includes(input.type)) {
        if (input.type === "checkbox") {
          if (!input.checked) valid = false;
        } else {
          if (!input.value.trim()) valid = false;
        }
      }
    });

    return valid;
  }

  next() {
    if (!this.validateStep(this.currentStep)) {
      this.showError();
      return;
    }

    if (this.currentStep < this.steps.length - 1) {
      this.currentStep++;
      this.updateUI();
    }
  }

  prev() {
    if (this.currentStep > 0) {
      this.currentStep--;
      this.updateUI();
    }
  }

  updateUI() {
    this.steps.forEach((step, i) => {
      step.classList.toggle("hidden", i !== this.currentStep);
    });

    // indicators
    this.indicators.forEach((el, i) => {
      el.classList.toggle("active", i === this.currentStep);
    });

    // buttons
    const nav = this.nextBtn.parentElement;
    if (this.currentStep === 0) {
      this.prevBtn.style.display = "none";
      nav.classList.remove("justify-between");
      nav.classList.add("justify-end");
    } else {
      this.prevBtn.style.display = "";
      this.prevBtn.style.visibility = "visible";
      nav.classList.add("justify-between");
      nav.classList.remove("justify-end");
    }

    if (this.currentStep === this.steps.length - 1) {
      this.nextBtn.style.display = "none";
      this.submitBtn?.classList.remove("hidden");
    } else {
      this.nextBtn.style.display = "inline-flex";
      this.submitBtn?.classList.add("hidden");
    }
  }

  showError() {
    // UX simple (tu peux remplacer par toast)
    const step = this.steps[this.currentStep];
    step.classList.add("animate-pulse");
    setTimeout(() => step.classList.remove("animate-pulse"), 400);
  }
}

// INIT
window.addEventListener("DOMContentLoaded", () => {
  new MultiStepWizard({
    stepSelector: ".step",
    nextBtn: "#btnNext",
    prevBtn: "#btnPrev",
    submitBtn: "#btnSubmit",
    indicatorSelector: ".step-indicator",
  });
});
