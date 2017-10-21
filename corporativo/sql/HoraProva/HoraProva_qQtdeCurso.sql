select
  count(*) as qtd, 
  curso.nome as curso,
  campus.nome as campus,
  facul.nome as facul
from
  horaprova,
  gradalu,
  turmaofe,
  turma,
  matric,
  facul,
  campus,
  curso
where
  Curso.CursoNivel_Id = 6200000000001
and
  horaprova.campus_id=campus.id
and
  horaprova.facul_id=facul.id
and
  turma.curso_id=curso.id
and
  (
    Turma.TurmaTi_Id = p_Turma_TurmaTi_Id
  or
    p_Turma_TurmaTi_Id is null
  )
and
  turmaofe.turma_id=turma.id
and
  matric.turmaofe_id=turmaofe.id
and
  gradalu.matric_id=matric.id
and
  gradalu.horaprova_esp_id=horaprova.id
and
  ( 
    p_Campus_Id is null
    or
    HoraProva.Campus_Id = nvl ( p_Campus_Id , 0 )
  )
and
  (
    HoraProva.Facul_Id = nvl ( p_Facul_Id , 0 )
    or
    p_Facul_Id is null
  )
and
  HoraProva.CriAvalPDt_Id = nvl( p_CriAvalPDt_Id , 0 )
group by curso.nome,campus.nome,facul.nome
order by Campus.Nome,Facul.Nome,Curso.Nome