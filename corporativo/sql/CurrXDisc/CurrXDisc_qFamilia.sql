select  
  CurrXDisc.Id,
  CurrXDisc.Curr_Id,
  CurrXDisc.Disc_Id,
  CurrXDisc.CHSemanal,
  CurrXDisc.CHSemanalTeoria,
  CurrXDisc.CHSemanalPratica,
  CurrXDisc.CHSemanalLab,
  CurrXDisc.CHSemanalExerc,
  CurrXDisc.ChTotal,
  CurrXDisc_gnCHTotal(CurrXDisc.Id, p_PLetivo_Id , p_GradAlu_Id ) as CHAnual,
  CurrXDisc.DuracXCi_Id,
  CurrXDisc.DiscCat_Id,
  CurrXDisc.Obrig,
  CurrXDisc.DiscSel_Id,
  CurrXDisc.CurrXDisc_SelOp_Id,
  CurrXDisc.SemSubs,
  CurrXDisc.SemProva,
  rpad(CurrXDisc_gsRetSerie(CurrXDisc.Id),20)||' '||rpad(CurrXDisc_gsRetCodDisc(CurrXDisc.Id),10)||' - '||DiscCat.Sigla as Recognize,
  shortName(Curr_gsRecognize(CurrXDisc.Curr_Id),150)       as Curr_Reduz,
  Curr_gsRecognize(CurrXDisc.Curr_Id)                      as Curr_Recognize,
  CurrXDisc_gsRetSerie(CurrXDisc.Id)                       as Serie,
  Disc.Nome                                                as Disc,
  DiscCat_gsRecognize(CurrXDisc.DiscCat_Id)                as Categoria,
  Curr.Codigo                                              as Curr_Codigo,
  Curr.Posicionamento                                      as Curr_Posicao,
  Curr.CurrNomeDipl                                        as Curso_Nome,
  CurrXDisc_gsRetCodDisc(currxdisc.id)                     as Disc_Codigo,
  Curr.Reconhecimento                                      as Reconhecimento,
  WPessoa_gsRecognize(Curso_gnCoordenador(Curr.Curso_Id))  as Coordenador,
  DiscCat.Estagio                                          as Cat_Estagio,
  CargaHoraTi.Nick                                         as ChNick, 
  Curr.CurrNomeHist || decode(Curr.CurrNivelDesc,null,Curr.CurrNivelDesc,' - ' || Curr.CurrNivelDesc) as NomeCurso,
  decode(CurrXDisc.DiscCat_Id,5900000000001,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000002,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000006,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000008,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000009,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000010,'99'||DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),5900000000014,DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id),'9'||DuracXCi_gsSerieHtml(CurrXDisc.DuracXCi_Id)) as OrdemSerie,
  decode(CurrXDisc.DiscCat_Id,5900000000001,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000002,'A'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000004,'B'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000003,'C'||CurrXDisc_gsRetDisc(CurrXDisc.Id)     ,5900000000010,'X'||CurrXDisc_gsRetDisc(CurrXDisc.Id),'X'||CurrXDisc_gsRetDisc(CurrXDisc.Id)) as OrdemDisc
from
  CargaHoraTi,
  CurrXDisc,
  Curr,
  Disc,
  DiscCat
where
  (
    p_DiscCat_Id is null
      or
    CurrXDisc.DiscCat_Id <= p_DiscCat_Id 
  )
and
  Disc.Id = CurrXDisc.Disc_Id
and
  CargaHoraTi.Id (+) = CurrXDisc.CargaHoraTi_Id
and
  DiscCat.Id (+) = CurrXDisc.DiscCat_Id
and
  Curr.Id = CurrXDisc.Curr_Id
and 
  (
    Curr_Id in 
     ( 
       select Curr.Id from Curr start with Curr.Id = nvl( p_Curr_Id ,0) connect by Curr.Curr_Pai_Id = PRIOR Curr.Id 
         union
       select Curr.Curr_Pai_Id from Curr start with Curr.Id = nvl( p_Curr_Id ,0) connect by Curr.Id = PRIOR Curr.Curr_Pai_Id 
     ) 
  )
order by
   Curr_Posicao,Curr_Codigo,OrdemSerie,OrdemDisc
