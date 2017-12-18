#include "lem_in.h"
#include <stdio.h>

int		check_line(char *templine, int *link)
{
	int		type;

	type = (*link);
	if ((*link) == 1)
		(*link)++;
	if (ft_strcmp(templine, "##start") == 0)
		(*link) = 0;
	if (ft_strcmp(templine, "##end") == 0)
		(*link) = 1;
	if (templine[0] == '#')
		return (0);
	if (type == 0 || type == 1)
		return (1);
	return (type);
}
void		add_node(char *line, t_itreelist **head)
{

	printf("Line: %s\n", line);
	char  **info;
	t_itreelist *new;
	t_itreelist	*current;

	info = ft_strsplit(line, ' ');
	new = (t_itreelist *)malloc(sizeof(t_itreelist));
	new->id = ft_atoi(info[0]);
	new->x = ft_atoi(info[1]);
	new->y = ft_atoi(info[2]);
	new->next = NULL;
	new->branches = NULL;
	new->branches_count = 0;


	if (*head != NULL)
	{
		current = *head;
		while (current->next != NULL)
			current = current->next;
		current->next = new;
	}
	else
		*head = new;
}

t_itreelist		**add_link_item(t_itreelist **branches, int branches_count, t_itreelist *link)
{
	t_itreelist		**tempb;
	int				tempbc;

	tempb = NULL;
	if (branches == NULL)
	{
		branches = (t_itreelist **)malloc(sizeof(t_itreelist *) * 1);
		branches[0] = link;
		return (branches);
	}
	else
	{
		tempb = (t_itreelist **)malloc(sizeof(t_itreelist *) * (branches_count + 1));
		tempbc = 0;
		while (tempbc < branches_count)
		{
			tempb[tempbc] = branches[tempbc];
			tempbc++;
		}
		tempb[tempbc] = link;
		free(branches);
	}
	return(tempb);
}
void		add_link(char *line, t_itreelist *head)
{
	t_itreelist *link1;
	int 		ilink1;
	t_itreelist	*link2;
	int			ilink2;
	char		**info;

	link1 = head;

	printf("Line: %s\n", line);
	info = ft_strsplit(line, '-');
	ilink1 = ft_atoi(info[0]);
	ilink2 = ft_atoi(info[1]);
	printf("Link: %i:%i\n", ilink1, ilink2);
	while (link1 != NULL && link1->id != ilink1)
		link1 = link1->next;
	link2 = head;
	while (link2 != NULL && link2->id != ilink2)
		link2 = link2->next;
	if (link1 != NULL && link2 != NULL)
	{
		link1->branches = add_link_item(link1->branches, link1->branches_count, link2);
		link1->branches_count++;
		link2->branches = add_link_item(link2->branches, link2->branches_count, link1);
		link2->branches_count++;
	}
}

int		lem_in(int const fd, char **line){
	t_itreelist *head;
	t_itreelist *current;
	int		tempint;
	char	*templine;
	int		link;
	int 	result;

	link = -1;
	*line = NULL;
	head = NULL;
	while ((tempint = get_next_line(fd, &templine)) > 0)
	{
		result = check_line(templine, &link);
		printf("Templine: %s, result: %i\n", templine, result);
		if (result == 1)
			// printf("== 1\n");
			add_node(templine, &head);
		if (result > 1)
			// printf("> 1\n");
			add_link(templine, head);
		ft_strdel(&templine);
	}
	current = head;
	while (current != NULL)
	{
		printf("*** Node: [%i] - x (%i) y (%i)  ***\n", current->id, current->x, current->y);
		if (current->next != NULL)
			printf("Next: %i\n", current->next->id);
		printf("Branch count: %i\n", current->branches_count);
		if (current->branches_count > 0)
		{
			int x = 0;
			while (x < current->branches_count)
			{
				printf("Link[%i]: %i\n", x, current->branches[x]->id);
				x++;
			}
		}
		current = current->next;
	}
	return (0);
}