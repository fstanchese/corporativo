select 
  falta_01 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_01_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_02 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_02_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_03 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_03_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_04 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_04_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_05 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_05_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_06 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_06_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_07 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_07_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_08 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_08_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_09 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_09_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_10 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_10_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_11 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_11_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_12 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_12_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_13 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_13_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_14 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_14_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_15 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_15_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_16 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_16_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_17 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_17_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_18 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_18_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_19 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_19_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_20 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_20_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_21 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_21_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_22 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_22_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_23 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_23_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_24 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_24_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_25 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_25_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_26 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_26_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_27 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_27_id = nvl( p_GradAlu_Id ,0)
union
select 
  falta_28 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt1 as Dt,to_char(LPre.Dt1,'dd/mm/yyyy hh24:mi') as Data, qtdaulas1 as qtdAulas, 
  1 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_28_id = nvl( p_GradAlu_Id ,0)
union
select 
  falta_01 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_01_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_02 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_02_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_03 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_03_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_04 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_04_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_05 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_05_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_06 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_06_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_07 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_07_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_08 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_08_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_09 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_09_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_10 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_10_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_11 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_11_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_12 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_12_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_13 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_13_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_14 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_14_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_15 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_15_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_16 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_16_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_17 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_17_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_18 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_18_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_19 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_19_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_20 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_20_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_21 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_21_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_22 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_22_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_23 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_23_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_24 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_24_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_25 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_25_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_26 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_26_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_27 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_27_id = nvl( p_GradAlu_Id ,0)
union
select 
  falta_28 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt2 as Dt,to_char(LPre.Dt2,'dd/mm/yyyy hh24:mi') as Data, qtdaulas2 as qtdAulas, 
  2 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_28_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_01 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_01_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_02 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_02_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_03 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_03_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_04 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_04_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_05 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_05_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_06 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_06_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_07 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_07_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_08 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_08_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_09 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_09_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_10 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_10_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_11 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_11_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_12 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_12_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_13 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_13_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_14 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_14_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_15 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_15_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_16 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_16_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_17 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_17_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_18 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_18_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_19 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_19_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_20 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_20_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_21 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_21_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_22 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_22_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_23 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_23_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_24 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_24_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_25 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_25_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_26 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_26_id = nvl( p_GradAlu_Id ,0) 
union
select 
  falta_27 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_27_id = nvl( p_GradAlu_Id ,0)
union
select 
  falta_28 as falta,
  lpre_id,
  LPreFolha.id,
  LPre.Dt3 as Dt,to_char(LPre.Dt3,'dd/mm/yyyy hh24:mi') as Data, qtdaulas3 as qtdAulas, 
  3 as Indice
from 
  LPreFolha,
  LPre   
where
  LPreFolha.LPre_Id = LPre.Id
and
  State_Id = 3000000009002 
and 
  GradAlu_28_id = nvl( p_GradAlu_Id ,0) 
order by Dt