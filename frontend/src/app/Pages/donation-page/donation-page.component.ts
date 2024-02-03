import { Component, inject } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import {
  FormsModule,
  ReactiveFormsModule,
  FormGroup,
  FormControl,
  Validators,
} from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-donation-page',
  standalone: true,
  imports: [CommonModule, FormsModule, ReactiveFormsModule],
  templateUrl: './donation-page.component.html',
  styleUrl: './donation-page.component.css',
})
export class DonationPageComponent {
  http = inject(HttpClient);

  res: any;

  form = new FormGroup({
    cardOwner: new FormControl('', [
      Validators.required,
      Validators.minLength(5),
    ]),
    cardNumber: new FormControl('', [
      Validators.required,
      Validators.min(999999999999999),
    ]),
    ExpDateMM: new FormControl('', [
      Validators.required,
      Validators.min(1),
      Validators.max(12),
    ]),
    ExpDateYY: new FormControl('', [Validators.required, Validators.min(1)]),
    CVV: new FormControl('', [
      Validators.required,
      Validators.min(99),
      Validators.max(999),
    ]),
    amount: new FormControl('', [Validators.required, Validators.min(1)]),
  });

  get f() {
    return this.form.controls;
  }

  submit() {
    this.http
      .post('http://127.0.0.1:8000/cards', this.form.value)
      .subscribe((res: any) => {
        console.log(res);
        this.res = res;
      });

    //console.log(this.form.value);
  }
}
