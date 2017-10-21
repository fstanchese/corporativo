(
select
  WPessoa.Id                         as WPessoa_Id,
  TurmaOfe_gnRetCurr(TurmaOfe_Id)    as Curr_Id,
  WPessoa_gsRecognize(WPessoa.Id)    as NomeAluno,
  Matric.Id                          as Matric_Id,
  Matric.Id                          as Matric_Up_Id
from
  Matric,
  WPessoa,
  TurmaOfe,
  Curr,
  CurrOfe
where
  Matric.MatricTi_Id = 8300000000001
and
  Matric.State_Id in ( 3000000002002,3000000002003,3000000002010,3000000002011,3000000002012 )
and
  Matric.WPessoa_Id = WPessoa.Id
and
  CurrOfe.Curr_Id = Curr.Id
and  
  (
    p_Curso_Id is null
      or
    Curr.Curso_Id = nvl( p_Curso_Id , 0)
  )
and
  ( 
     p_WPessoa_Id is null
      or
     Matric.WPessoa_Id = nvl ( p_WPessoa_Id , 0 )
  )  
and
  Matric.TurmaOfe_Id = TurmaOfe.Id
and
  (
    p_TurmaOfe_Id is null
      or 
    TurmaOfe.Id = nvl( p_TurmaOfe_Id ,0 )
  )
and
  TurmaOfe.CurrOfe_Id = CurrOfe.Id
and
  CurrOfe.PLetivo_Id = nvl ( p_PLetivo_Id , 0 )
and
  p_O_Check1 = 'off'
)
union
(
select * from 
(
select
  GradAlu.WPessoa_Id                      as WPessoa_Id,
  CurrOfe.Curr_Id                         as Curr_Id,
  WPessoa_gsRecognize(GradAlu.WPessoa_Id) as NomeAluno,
  Matric.Id                               as Matric_Id,
  Matric.Id                               as Matric_Up_Id
from
  GradAluHi,
  GradAlu,
  TurmaOfe,
  CurrOfe,
  Matric
where
  Matric.Atualizar is not null
and
  GradAluHi.Col like 'N%'
and
  GradAluHi.Old is not null
and
  GradAlu.Matric_Id    = Matric.Id
and
  TurmaOfe.CurrOfe_Id  = CurrOfe.Id
and
  GradAlu.TurmaOfe_Id  = TurmaOfe.Id
and
  GradAlu.GradAluTi_Id = 8500000000001
and
  GradAluHi.GradAlu_Id = GradAlu.Id
and
  CurrOfe.PLetivo_Id = nvl ( 7200000000082 , 0)
and
  p_O_Check1 = 'on'
union
select
  GradAlu.WPessoa_Id                      as WPessoa_Id,
  CurrOfe.Curr_Id                         as Curr_Id,
  WPessoa_gsRecognize(GradAlu.WPessoa_Id) as NomeAluno,
  Matric.Id                               as Matric_Id,
  Decode(Matric.Atualizar,null,MatricPai.Id,Matric.Id) as Matric_Up_Id  
from
  GradAluHi,
  GradAlu,
  ( select id,matric_pai_id,turmaofe_id,atualizar from matric where matric_pai_id is not null) MATRICPAI,
  matric,
  turmaofe,
  CurrOfe
where
 ( Matric.Atualizar is not null or matricpai.atualizar is not null )
and
  GradAluHi.Col like 'N%'
and
  GradAluHi.Old is not null
and
  TurmaOfe.CUrrOfe_Id = CurrOfe.Id
and
  turmaofe.id=matric.turmaofe_Id
and
  matricpai.matric_pai_id=matric.id
and
  MATRICPAI.id = gradalu.matric_Id
and
  GradAlu.GradAluTi_Id <> 8500000000001
and
  GradAluHi.GradAlu_Id = GradAlu.Id
and
  CurrOfe.PLetivo_Id = nvl( 7200000000082 , 0 )
and
  p_O_Check1 = 'on'
)
group by wpessoa_id,curr_id,nomealuno,matric_id,matric_up_id
)
order by 3
