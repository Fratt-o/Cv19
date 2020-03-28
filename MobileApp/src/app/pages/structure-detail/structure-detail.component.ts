import { Component, OnInit } from '@angular/core';
import {ActivatedRoute, Router} from '@angular/router';
import {RetrieverService} from '../../services/retriever.service';
import {Structure} from '../../models/structure';
import {HttpClient} from '@angular/common/http';
import {AuthService} from '../../services/auth.service';

@Component({
  selector: 'app-structure-detail',
  templateUrl: './structure-detail.component.html',
  styleUrls: ['./structure-detail.component.scss'],
})
export class StructureDetailComponent implements OnInit {
  structure: Structure;
  error: any = false;
  constructor(private activatedRoute: ActivatedRoute,
              private rtrService: RetrieverService, private router: Router,
              private authService: AuthService
              ) {
    activatedRoute.params.subscribe(params => {
      if (params.id) {
        this.rtrService.structureDetail(params.id).subscribe((struttura) => {
          this.structure = struttura;
        }, (err) => {
          this.error = true;
        });
      }
    });
  }

  showReviews(): boolean {
    return this.authService.isAuthenticated();
  }

  ngOnInit() {}

  goToStructure(): void {
    this.router.navigateByUrl('');
  }
}


