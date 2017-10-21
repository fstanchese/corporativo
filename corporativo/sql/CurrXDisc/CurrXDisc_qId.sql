select  
  CurrXDisc.*,
  CurrXDisc_gnCHTotal(CurrXDisc.Id, p_PLetivo_Id , p_GradAlu_Id ) as CHAnual,
  CurrXDisc_gsRecognize(CurrXDisc.Id)              as Recognize,
  Disc.Codigo                                      as DiscCodigo,
  Disc_gsRecognize(Disc.Id)                        as DiscRecognize, 
  Disc_gsRecognize(Disc.Id)                        as Disc_Id_R,
  Curr.Codigo                                      as CodigoCurr,
  Curr_gsRecognize(Curr.Id)                        as Curr_Id_R,
  Curso.Nome                                       as Curso,
  Curso.Id                                         as Curso_Id,
  Facul_gsRecognize(Curso.Facul_Id)                as FaculRecognize,
  Facul.NomeCompleto                               as FaculCompleto,
  DuracXCi_gsRecognize(CurrXDisc.DuracXCi_Id)      as Serie,
  Curr.CurrNomeHist || decode(Curr.CURRCOMPNOME,null,'',' - ' || Curr.CURRCOMPNOME) || decode(Curr.CurrNivelDesc,null,'',' - ' || Curr.CurrNivelDesc) as NomeCurso,
  CurrXDisc_gsRetDisc(CurrXDisc.Id)                as Disciplina,
  DiscCat.Sigla                                    as DiscCat_Sig
from  
  Facul,
  Curso,
  Curr,
  Disc,
  CurrXDisc,
  DiscCat  
where  
  DiscCat.Id (+) = CurrXDisc.DiscCat_Id
and
  Facul.Id (+) = Curso.Facul_Id
and
  Curr.Curso_Id = Curso.Id
and
  CurrXDisc.Curr_Id = Curr.Id
and
  CurrXDisc.Disc_Id = Disc.Id
and
  CurrXDisc.Id = nvl( p_CurrXDisc_Id ,0)
