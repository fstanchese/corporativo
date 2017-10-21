select
  GradAlu_gsRetMediaFinal(GradAlu.Id)        as MediaFinal,
  GradAlu_gnRetPLetivo(GradAlu.Id)           as PLetivo_Id,
  State_gsRecognize(State_Id)                as State,
  Curr.Curso_Id                              as Curso_Id,
  Curr.Id                                    as Curr_Id,
  GradAlu.Id                                 as GradAlu_Id,
  GradAlu.CurrXDisc_Id                       as CurrXDisc_Id,
  nvl(CXDEqui.ChAnual,CurrXDisc_gnChTotal(GradAlu.CurrXDisc_Id,GradAlu_gnRetPLetivo(GradAlu.Id),GradAlu.Id)) as ChAnual,
  (CurrXDisc_gnChTotal(GradAlu.CurrXDisc_Id,GradAlu_gnRetPLetivo(GradAlu.Id),GradAlu.Id)*CXDEqui.ChAnual) as ChEqui,
  CurrXDisc_gnChTotal(GradAlu.CurrXDisc_Id,GradAlu_gnRetPLetivo(GradAlu.Id),GradAlu.Id) as ChTotal,
  GradAlu.GradAluTi_Id,
  rpad(CurrXDisc_gsRetSerie(CurrXDisc.Id),20)||' - '||CurrXDisc_gsRetCodDisc(CurrXDisc.Id)||' - '||CurrXDisc_gsRetDisc(CurrXDisc.Id) as Descricao,
  PLetivo_gsRetNome(GradAlu_gnRetPLetivo(GradAlu.Id))  as PLetivo
from 
  GradAlu,
  CXDEqui, 
  CurrXDisc,
  Curr
where
  CurrXDisc.Curr_Id = Curr.Id
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id
and
  GradAlu.State_Id = nvl( p_State_Id ,0)
and
  GradAlu.CurrXDisc_Id = CXDEqui.CurrXDisc_Equi_Id
and
  CXDEqui.WPessoa_Id is null
and
  CXDEqui.Grupo is null
and
  CXDEqui.CurrXDisc_Id = nvl( p_CurrXDisc_Equi_Id ,0)
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
union
select
  GradAlu_gsRetMediaFinal(GradAlu.Id)        as MediaFinal,
  GradAlu_gnRetPLetivo(GradAlu.Id)           as PLetivo_Id,
  State_gsRecognize(State_Id)                as State,
  Curr.Curso_Id                              as Curso_Id,
  Curr.Id                                    as Curr_Id,
  GradAlu.Id                                 as GradAlu_Id,
  GradAlu.CurrXDisc_Id                       as CurrXDisc_Id,
  nvl(CXDEqui.ChAnual,CurrXDisc_gnChTotal(GradAlu.CurrXDisc_Id,GradAlu_gnRetPLetivo(GradAlu.Id),GradAlu.Id)) as ChAnual,
  (CurrXDisc_gnChTotal(GradAlu.CurrXDisc_Id,GradAlu_gnRetPLetivo(GradAlu.Id),GradAlu.Id)*CXDEqui.ChAnual) as ChEqui,
  CurrXDisc_gnChTotal(GradAlu.CurrXDisc_Id,GradAlu_gnRetPLetivo(GradAlu.Id),GradAlu.Id) as ChTotal,
  GradAlu.GradAluTi_Id,
  rpad(CurrXDisc_gsRetSerie(CurrXDisc.Id),20)||' - '||CurrXDisc_gsRetCodDisc(CurrXDisc.Id)||' - '||CurrXDisc_gsRetDisc(CurrXDisc.Id) as Descricao,
  PLetivo_gsRetNome(GradAlu_gnRetPLetivo(GradAlu.Id))  as PLetivo
from 
  GradAlu,
  CXDEqui, 
  CurrXDisc,
  Curr
where
  CurrXDisc.Curr_Id = Curr.Id
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id
and
  GradAlu.State_Id = nvl( p_State_Id ,0)
and
  GradAlu.CurrXDisc_Id = CXDEqui.CurrXDisc_Equi_Id
and
  CXDEqui.WPessoa_Id is null
and
  CXDEqui_gnGrupoAprovado( p_WPessoa_Id , CXDEqui.Grupo )=1 
and
  CXDEqui.Grupo is not null
and
  CXDEqui.CurrXDisc_Id = nvl( p_CurrXDisc_Equi_Id ,0)
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
union
select
  GradAlu_gsRetMediaFinal(GradAlu.Id)        as MediaFinal,
  GradAlu_gnRetPLetivo(GradAlu.Id)           as PLetivo_Id,
  State_gsRecognize(State_Id)                as State,
  Curr.Curso_Id                              as Curso_Id,
  Curr.Id                                    as Curr_Id,
  GradAlu.Id                                 as GradAlu_Id,
  GradAlu.CurrXDisc_Id                       as CurrXDisc_Id,
  nvl(CXDEqui.ChAnual,CurrXDisc_gnChTotal(GradAlu.CurrXDisc_Id,GradAlu_gnRetPLetivo(GradAlu.Id),GradAlu.Id)) as ChAnual,
  (CurrXDisc_gnChTotal(GradAlu.CurrXDisc_Id,GradAlu_gnRetPLetivo(GradAlu.Id),GradAlu.Id)*CXDEqui.ChAnual) as ChEqui,
  CurrXDisc_gnChTotal(GradAlu.CurrXDisc_Id,GradAlu_gnRetPLetivo(GradAlu.Id),GradAlu.Id) as ChTotal,
  GradAlu.GradAluTi_Id,
  rpad(CurrXDisc_gsRetSerie(CurrXDisc.Id),20)||' - '||CurrXDisc_gsRetCodDisc(CurrXDisc.Id)||' - '||CurrXDisc_gsRetDisc(CurrXDisc.Id) as Descricao,
  PLetivo_gsRetNome(GradAlu_gnRetPLetivo(GradAlu.Id))  as PLetivo
from 
  GradAlu,
  CXDEqui, 
  CurrXDisc,
  Curr
where
  CurrXDisc.Curr_Id = Curr.Id
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id
and
  GradAlu.State_Id = nvl( p_State_Id ,0)
and
  GradAlu.CurrXDisc_Id = CXDEqui.CurrXDisc_Id
and
  CXDEqui.WPessoa_Id is null
and
  CXDEqui.Grupo is null
and
  CXDEqui.CurrXDisc_Equi_Id = nvl( p_CurrXDisc_Equi_Id ,0)
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
union
select
  GradAlu_gsRetMediaFinal(GradAlu.Id)        as MediaFinal,
  GradAlu_gnRetPLetivo(GradAlu.Id)           as PLetivo_Id,
  State_gsRecognize(State_Id)                as State,
  Curr.Curso_Id                              as Curso_Id,
  Curr.Id                                    as Curr_Id,
  GradAlu.Id                                 as GradAlu_Id,
  GradAlu.CurrXDisc_Id                       as CurrXDisc_Id,
  nvl(CXDEqui.ChAnual,CurrXDisc_gnChTotal(GradAlu.CurrXDisc_Id,GradAlu_gnRetPLetivo(GradAlu.Id),GradAlu.Id)) as ChAnual,
  (CurrXDisc_gnChTotal(GradAlu.CurrXDisc_Id,GradAlu_gnRetPLetivo(GradAlu.Id),GradAlu.Id)*CXDEqui.ChAnual) as ChEqui,
  CurrXDisc_gnChTotal(GradAlu.CurrXDisc_Id,GradAlu_gnRetPLetivo(GradAlu.Id),GradAlu.Id) as ChTotal,
  GradAlu.GradAluTi_Id,
  rpad(CurrXDisc_gsRetSerie(CurrXDisc.Id),20)||' - '||CurrXDisc_gsRetCodDisc(CurrXDisc.Id)||' - '||CurrXDisc_gsRetDisc(CurrXDisc.Id) as Descricao,
  PLetivo_gsRetNome(GradAlu_gnRetPLetivo(GradAlu.Id))  as PLetivo
from 
  GradAlu,
  CXDEqui, 
  CurrXDisc,
  Curr
where
  CurrXDisc.Curr_Id = Curr.Id
and
  GradAlu.CurrXDisc_Id = CurrXDisc.Id
and
  GradAlu.State_Id = nvl( p_State_Id ,0)
and
  GradAlu.CurrXDisc_Id = CXDEqui.CurrXDisc_Id
and
  CXDEqui.WPessoa_Id is null
and
  CXDEqui.Grupo is not null
and
  CXDEqui.CurrXDisc_Equi_Id = nvl( p_CurrXDisc_Equi_Id ,0)
and
  GradAlu.WPessoa_Id = nvl( p_WPessoa_Id ,0)
