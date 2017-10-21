select 
	State.Id, 
	State.Nome as Recognize, 
	State.Nick, 
	State.State_Id, 
	State_gsRecognize(State.State_Id) 
from 
	StateTi,
	State 
where 
	State.StateTi_Id = StateTi.Id 
and
	StateTi.id = p_StateTi_Id 
order by State.Nome