export class Notification {
  closeButton(button: HTMLElement): void {
    button.addEventListener("click", () => {
      this.reset();
    });
  }

  reset(): void {
    const notifications = document.querySelectorAll(".wpt-notification");
    notifications.forEach((notification) => {
      notification.classList.add("wpt-notification-close");
      setTimeout(() => {
        notification.remove();
      }, 1000);
    });
  }
}
