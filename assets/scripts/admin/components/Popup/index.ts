export class Popup {
  constructor() {
    this.reset();
  }

  create() {
    const body: HTMLElement | null = document.querySelector("body");

    const icon = this.createElement('i', 'wpt-popup-icon');
    const iconDiv = this.createElement('div', '', ['wpt-popup-icon'], [icon]);

    const title = this.createElement('span', 'wpt-popup-title');
    const titleDiv = this.createElement('div', '', ['wpt-popup-title'], [title]);

    const message = this.createElement('span', 'wpt-popup-message');
    const messageDiv = this.createElement('div', '', ['wpt-popup-message'], [message]);
    
    const popup = this.createElement('div', '', ['wpt-popup'], [iconDiv, titleDiv, messageDiv]);
    const darker = this.createElement('div', '', ['wpt-darker'], [popup]);

    body?.appendChild(darker);
  }

  createElement(tag: string, id: string = '', classes: Array<string> = [], childs: Array<HTMLElement> = []) {
    const element = document.createElement(tag);
    if (id) {
      element.setAttribute('id', id);
    }

    if (classes.length > 0){
      classes.forEach(item => {
        element.classList.add(item);
      });
    }

    if (childs.length > 0){
      childs.forEach(child => {
        element.appendChild(child);
      });
    }

    return element;
  }

  setIcon(type: string) {
    const icon: HTMLElement | null = document.querySelector(
      "#wpt-popup-icon"
    );

    if (icon) {
      switch (type) {
        case "error":
          icon.className = "fa-solid fa-circle-xmark";
          break;

        case "success":
          icon.className = "fa-solid fa-circle-check";
          break;

        case "loading":
          icon.className = "fa-solid fa-spinner";
          break;

        case "warning":
          icon.className = "fa-solid fa-triangle-exclamation";
          break;

        default:
          icon.className = "";
          break;
      }
    }
  }

  setMessage(content: string) {
    const message: HTMLElement | null = document.querySelector(
      "#wpt-popup-message"
    );
    if (message) {
      message.innerText = content;
    }
  }

  setTitle(content: string) {
    const title: HTMLElement | null = document.querySelector(
      "#wpt-popup-title"
    );
    if (title) {
      title.innerText = content;
    }
  }

  setButton(text: string, classes: string, id: string) {
    const popup: HTMLElement | null =
      document.querySelector(".wpt-popup");
    const button: any = document.createElement("input");

    if (button) {
      button.setAttribute("type", "button");
      button.setAttribute("id", id);
      button.classList = classes;
      button.value = text;

      const divButton: HTMLElement = document.createElement("div");
      divButton.classList.add("wpt-popup-button");
      divButton.appendChild(button);

      popup?.appendChild(divButton);
    }
  }

  setButtons(data: Array<{ id: string; classes: string; text: string }>) {
    const popup = document.querySelector(".wpt-popup");

    const divButton: HTMLElement = document.createElement("div");
    divButton.classList.add("wpt-popup-button");

    data.forEach((button) => {
      const element: any = document.createElement("input");
      console.log(element);
      if (element) {
        element.setAttribute("type", "button");
        element.setAttribute("id", button.id);
        element.classList = button.classes;
        element.value = button.text;

        divButton.appendChild(element);
      }
    });

    popup?.appendChild(divButton);
  }

  reset() {
    const elements: Array<string> = [
      "#wpt-popup-icon",
      "#wpt-popup-title",
      "#wpt-popup-message",
      ".wpt-popup",
      ".wpt-darker",
    ];

    elements.forEach((id) => {
      const element: HTMLElement | null = document.querySelector(id);
      if (element) {
        element.remove();
      }
    });
  }
}
