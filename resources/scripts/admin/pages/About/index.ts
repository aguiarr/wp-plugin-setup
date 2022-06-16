import { Notification } from "../../components/Notification";

export class About {
  constructor() {
    if (!document.querySelector(".wpt-container-about")) return;
    this.handleNotification();
  }

  handleNotification(): void {
    new Notification("Hello World!", "This is a example notification", 5);
  }
}
