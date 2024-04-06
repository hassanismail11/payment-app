import { HttpClient } from '@angular/common/http';
import { Component, OnInit, inject } from '@angular/core';

@Component({
  selector: 'app-about-page',
  standalone: true,
  imports: [],
  templateUrl: './about-page.component.html',
  styleUrl: './about-page.component.css',
})
export class AboutPageComponent implements OnInit {
  http = inject(HttpClient);
  cards: any = [];

  ngOnInit(): void {
    this.fetchCards();
  }

  fetchCards() {
    this.http.get('http://127.0.0.1:8000/cards').subscribe(
      (res) => {
        this.cards = res;
      },
      (err) => {
        console.error(err);
      }
    );
  }
}
