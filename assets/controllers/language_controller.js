import { Controller } from 'stimulus';

export default class extends Controller {
    connect() {
        this.element.classList.remove('hidden-without-js');
    }

    redirect() {
        document.location = this.element.value;
    }
}
