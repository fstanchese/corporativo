select
  decode( p_O_Check1 ,'a',curr.currnomehist,'b',curr.currnomehist,'c',curso.nome,currnomehist) as nomecurso, 
  wpessoa.nome                         as nomealuno,  
  turmaofe_gsretcodturma(turmaofe_id)  as turma,
  wpessoa.rgrneformatado               as rg,
  to_char(tempcolacao.dtcolacao,'dd-mm-yyyy') as dtcolacao,
  wpessoa.codigo                       as RA,
  WPessoa_gsRecognize(WPessoa_Pres_Id) as Presidente,
  ColacaoGrau.Localizacao              as Local,
  ColacaoGrau.Horario                  as Horario,
  Matric.WPessoa_Id                    as WPessoa_Id,
  PLetivo.Nome                         as PLetivo,
  WPessoa_Pres_Id                      as WPessoa_Pres_Id
from
  pletivo,
  wpessoa,
  tempcolacao,
  matric,
  currofe,
  curr,
  curso,
  turmaofe,
  colacaograu
where
  colacaograu.id in ( select id from colacaograu where colacaograuti_id = 124200000000001  and dtcolacao = p_ColacaoGrau_DtColacao )
and
  tempcolacao.dtcolacao = p_ColacaoGrau_DtColacao
and
  wpessoa.id=matric.wpessoa_id
and
  tempcolacao.matric_id = matric.id
and
  matric.turmaofe_id = turmaofe.id
and
  pletivo.id = currofe.pletivo_id
and
  turmaofe.currofe_id = currofe.id
and
  curr.curso_id = curso.id
and
  curr.id = currofe.curr_id
and
  colacaograu.curso_id = curr.curso_id
and
  (
     p_Turma_Id is null
     or
     TurmaOfe.Turma_Id = nvl( p_Turma_Id , 0)
  )
and
  colacaograu.curso_id = nvl ( p_Curso_Id , 0 )
order by $p_O_OrderBy 

